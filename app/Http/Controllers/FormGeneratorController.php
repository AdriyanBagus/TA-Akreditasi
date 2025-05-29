<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        // 5. Generate view folder + files
        $viewFolder = resource_path('views/' . Str::kebab(Str::plural($modelName)));
        if (!File::exists($viewFolder)) {
            File::makeDirectory($viewFolder, 0755, true);
        }

        $formFields = '';
        foreach ($request->field_names as $name) {
            $formFields .= "<div class='form-group'>
            <label for='$name'>$name</label>
            <input type='text' name='$name' class='form-control' value='{{ old('$name', \$item->$name ?? '') }}'>
        </div>\n";
        }

        $createView = "<h1>Create {$modelName}</h1>
<form action='{{ route('{$tableName}.store') }}' method='POST'>
    @csrf
    $formFields
    <button type='submit' class='btn btn-primary'>Save</button>
</form>";

        $editView = "<h1>Edit {$modelName}</h1>
<form action='{{ route('{$tableName}.update', \$item->id) }}' method='POST'>
    @csrf
    @method('PUT')
    $formFields
    <button type='submit' class='btn btn-primary'>Update</button>
</form>";

        File::put($viewFolder . '/create.blade.php', $createView);
        File::put($viewFolder . '/edit.blade.php', $editView);
        File::put($viewFolder . '/index.blade.php', "<h1>{$modelName} Index</h1>");
        File::put($viewFolder . '/show.blade.php', "<h1>Show {$modelName}</h1>");

        return redirect('generator')->with('success', 'Form, Model, Controller, dan CRUD berhasil dibuat!');
    }

}
