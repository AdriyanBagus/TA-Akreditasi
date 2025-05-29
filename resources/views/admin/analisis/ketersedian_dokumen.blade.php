<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ketersediaan Dokumen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg p-6">
                <table class="min-w-full bg-white border border-gray-500">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('ketersediaan_dokumen', ['sort_by' => 'nama_user', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Nama Prodi</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('ketersediaan_dokumen', ['sort_by' => 'visi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Kegiatan</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('ketersediaan_dokumen', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">ketersediaan dokumen</a>
                            </th>
                            <th class="px-4 py-2 border">nomer dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ketersediaan_dokumen as $data)
                            <tr>
                                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border">{{ $data->nama_user }}</td>
                                <td class="px-4 py-2 border">{{ $data->kegiatan }}</td>
                                <td class="px-4 py-2 border">{{ $data->ketersediaan_dokumen }}</td>
                                <td class="px-4 py-2 border">{{ $data->nomor_dokumen }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($ketersediaan_dokumen->isEmpty())
                    <p class="text-center text-gray-500 mt-4">Tidak ada pengguna yang terdaftar.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>