<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Form Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg p-6">

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('form-generator.generate') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="model_name" class="form-label">Nama Form Baru</label>
                        <input type="text" name="model_name" id="model_name" class="form-control"
                            placeholder="Contoh: Article">
                    </div>

                    <label class="form-label">Kolom</label>
                    <div id="fields-container"></div>
                    <button type="button" class="btn btn-secondary btn-sm mb-1" onclick="addField()">+ Tambah
                        Kolom</button>

                    <button type="submit" class="btn btn-primary">Generate</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addField() {
            const container = document.getElementById('fields-container');
            const index = container.children.length;
            const row = document.createElement('div');
            row.className = 'row mb-2 align-items-center';
            row.innerHTML = `
                <div class="col">
                    <input type="text" name="field_names[]" class="form-control" placeholder="Nama Kolom">
                </div>
                <div class="col">
                    <select name="field_types[]" class="form-control">
                        <option value="string">string</option>
                        <option value="text">text</option>
                        <option value="integer">integer</option>
                        <option value="boolean">boolean</option>
                        <option value="date">date</option>
                        <option value="datetime">datetime</option>
                        <option value="decimal(8,2)">decimal(8,2)</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeField(this)">-</button>
                </div>
            `;
            container.appendChild(row);
        }

        function removeField(button) {
            const row = button.closest('.row');
            row.remove();
        }
    </script>
</x-app-layout>