<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Dosen') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 max-w-xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <form method="POST" action="{{ route('dosen.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Asal Prodi</label>
                    <select name="asal_prodi" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        <option value="">-- Pilih Prodi --</option>
                        @foreach ($prodiList as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" />
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-1">NIDN</label>
                    <input type="text" name="nidn" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" />
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>