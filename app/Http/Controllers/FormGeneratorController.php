<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormSetting;
use App\Models\menuAdmin;
use App\Models\menu;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class FormGeneratorController extends Controller
{
    public function index()
    {
        return view('admin.form-generator');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'model_name' => 'required|string',
            'field_names' => 'required|array',
            'field_types' => 'required|array'
        ]);

        $modelName = Str::studly($request->model_name);
        $tableName = Str::snake(Str::plural($modelName));

        $fields = [];
        foreach ($request->field_names as $i => $name) {
            $type = $request->field_types[$i] ?? 'string';
            $fields[] = "$name:$type";
        }

        // 1. Generate model + migration
        Artisan::call('make:model', [
            'name' => $modelName,
            '--migration' => true,
        ]);

        // 2. Edit migration file
        $migrationPath = database_path('migrations');
        $migrationFile = collect(scandir($migrationPath))->filter(function ($file) use ($tableName) {
            return str_contains($file, "create_{$tableName}_table");
        })->last();

        if ($migrationFile) {
            $fullPath = $migrationPath . '/' . $migrationFile;
            $schema = "";
            // Tambahkan user_id otomatis
            $schema .= "    \$table->unsignedBigInteger('user_id');\n";
            $schema .= "    \$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');\n";

            foreach ($fields as $field) {
                preg_match('/(\w+):(.*)/', $field, $matches);
                if (count($matches) === 3) {
                    $name = $matches[1];
                    $typeWithArgs = $matches[2];

                    if (preg_match('/(\w+)\((.*)\)/', $typeWithArgs, $typeMatch)) {
                        $type = $typeMatch[1];
                        $args = explode(',', $typeMatch[2]);
                        $argsString = implode(', ', array_map('trim', $args));
                        $schema .= "    \$table->$type('$name', $argsString);\n";
                    } else {
                        $schema .= "    \$table->$typeWithArgs('$name');\n";
                    }
                }
            }

            // dd($fields);

            $tableCreateCode = "Schema::create('$tableName', function (Blueprint \$table) {\n";
            $tableCreateCode .= "    \$table->id();\n";
            $tableCreateCode .= $schema;
            $tableCreateCode .= "    \$table->timestamps();\n";
            $tableCreateCode .= "});";

            // dd($tableCreateCode);

            $content = file_get_contents($fullPath);
            $lines = explode("\n", $content);
            $upStart = null;
            $upEnd = null;

            foreach ($lines as $i => $line) {
                if (str_contains($line, 'public function up')) {
                    $upStart = $i;
                }
                if ($upStart !== null && str_contains($line, 'public function down')) {
                    $upEnd = $i - 1;
                    break;
                }
            }

            if ($upStart !== null && $upEnd !== null) {
                $beforeUp = array_slice($lines, 0, $upStart);
                $afterUp = array_slice($lines, $upEnd + 1);

                $newUp = [
                    '    public function up(): void',
                    '    {',
                    '        ' . $tableCreateCode,
                    '    }',
                ];

                $newContent = implode("\n", array_merge($beforeUp, $newUp, $afterUp));
                file_put_contents($fullPath, $newContent);
            }
        }

        // dd($content);

        Artisan::call('migrate');

        // 3. Update model file
        $modelPath = app_path("Models/{$modelName}.php");
        if (File::exists($modelPath)) {
            $fillableFields = implode(", ", array_map(fn($field) => "'$field'", $request->field_names));

            $relations = '';
            foreach ($request->field_names as $fieldName) {
                if (Str::endsWith($fieldName, '_id')) {
                    $relatedModel = Str::studly(str_replace('_id', '', $fieldName));
                    $relationName = Str::camel(str_replace('_id', '', $fieldName));
                    $relations .= "\n    public function {$relationName}()\n    {\n        return \$this->belongsTo({$relatedModel}::class);\n    }\n";
                }
            }

            $modelContent = <<<PHP
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class $modelName extends Model
{
    use HasFactory;
    protected \$table = '$modelName';
    protected \$fillable = [$fillableFields];
    $relations
}
PHP;

            File::put($modelPath, $modelContent);
        }

        // dd($modelContent);

        // 4. Generate controller resource
        Artisan::call('make:controller', [
            'name' => $modelName . 'Controller',
            '--resource' => true
        ]);

        $controllerPath = app_path("Http/Controllers/{$modelName}Controller.php");

        $validationRules = implode(",\n            ", array_map(function ($field) {
            return "'$field' => 'required'";
        }, $request->field_names));

        $controllerContent = <<<EOT
<?php

namespace App\Http\Controllers;

use App\Models\\$modelName;
use Illuminate\Http\Request;

class {$modelName}Controller extends Controller
{
    public function index()
    {
        \$items = $modelName::all();
        return view('{$tableName}.index', compact('items'));
    }

    public function create()
    {
        return view('{$tableName}.create');
    }

    public function store(Request \$request)
    {
        \$validated = \$request->validate([
            $validationRules
        ]);

        $modelName::create(\$validated);

        return redirect()->route('{$tableName}.index')->with('success', '$modelName created!');
    }

    public function edit($modelName \$item)
    {
        return view('{$tableName}.edit', compact('item'));
    }

    public function update(Request \$request, $modelName \$item)
    {
        \$validated = \$request->validate([
            $validationRules
        ]);

        \$item->update(\$validated);

        return redirect()->route('{$tableName}.index')->with('success', '$modelName updated!');
    }

    public function destroy($modelName \$item)
    {
        \$item->delete();
        return redirect()->route('{$tableName}.index')->with('success', '$modelName deleted!');
    }
}
EOT;

        file_put_contents($controllerPath, $controllerContent);

        // 5. Generate view folder jika belum ada
        $viewFolder = resource_path('views/generated');
        if (!File::exists($viewFolder)) {
            File::makeDirectory($viewFolder, 0755, true);
        }

        // Nama file view berdasarkan model (snake_case)
        $viewFileName = Str::snake($modelName) . '.blade.php';

        // Buat baris tabel untuk setiap field
        $tableHeaders = '';
        $tableData = '';
        $modalFields = '';
        foreach ($request->field_names as $name) {
            $tableHeaders .= "<th class=\"px-4 py-2 border text-sm\">" . ucfirst($name) . "</th>\n";
            $tableData .= "<td class=\"px-4 py-2 border text-sm\">{{ \$item->$name }}</td>\n";
            $modalFields .= <<<HTML
    <div class="mb-3">
        <label for="$name" class="form-label">{$name}:</label>
        <input type="text" class="form-control" id="$name" name="$name" value="{{ session('$name') }}" required>
    </div>

HTML;
        }

        $bladeContent = <<<BLADE
<x-app-layout>
    <x-slot name="header">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Analisis {$modelName}') }}
            </h2>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah
            </button>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg p-6">
                <table class="min-w-full bg-white border border-gray-500">
                    <thead>
                        <tr>
                            <th class="px-2 py-2 border text-sm">No</th>
                            {$tableHeaders}
                            <th class="px-4 py-2 border text-sm">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (\${Str::camel(Str::plural($modelName))} as \$item)
                            <tr>
                                <td class="px-1 py-2 border text-sm">{{ \$loop->iteration }}</td>
                                {$tableData}
                                <td class="px-1 py-3 border flex flex-col items-center space-y-2">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{ \$item->id }}">
                                        Edit
                                    </button>
                                    <form action="{{ route('pages.{$viewFileName}.destroy', \$item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" id="exampleModal{{ \$item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('pages.{$viewFileName}.update', \$item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="id" value="{{ \$item->id }}">
                                                {$modalFields}
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('pages.{$viewFileName}.add') }}" method="POST">
                                    @csrf
                                    {$modalFields}
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @if (\${Str::camel(Str::plural($modelName))}->isEmpty())
                    <p class="text-center text-gray-500 mt-4">Tidak ada data.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
BLADE;

        // Simpan ke file
        File::put($viewFolder . '/' . $viewFileName, $bladeContent);

        return redirect('generator')->with('success', "File {$viewFileName} berhasil dibuat!");
    }

}
