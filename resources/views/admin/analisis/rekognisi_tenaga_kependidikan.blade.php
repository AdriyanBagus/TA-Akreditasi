<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rekognisi Tenaga Kependidikan') }}
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
                                <a href="{{ route('rekognisi_tenaga_kependidikan', ['sort_by' => 'nama_user', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Nama Prodi</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('rekognisi_tenaga_kependidikan', ['sort_by' => 'visi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Nama</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('rekognisi_tenaga_kependidikan', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Bidang Keahlian</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('rekognisi_tenaga_kependidikan', ['sort_by' => 'visi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Jenis Rekognisi</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('rekognisi_tenaga_kependidikan', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">tingkat</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('rekognisi_tenaga_kependidikan', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Tahun Perolehan</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rekognisi_tenaga_kependidikan as $data)
                            <tr>
                                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border">{{ $data->nama_user }}</td>
                                <td class="px-4 py-2 border">{{ $data->nama }}</td>
                                <td class="px-4 py-2 border">{{ $data->bidang_keahlian }}</td>
                                <td class="px-4 py-2 border">{{ $data->jenis_rekognisi }}</td>
                                <td class="px-4 py-2 border">{{ $data->tingkat }}</td>
                                <td class="px-4 py-2 border">{{ $data->tahun_perolehan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($rekognisi_tenaga_kependidikan->isEmpty())
                    <p class="text-center text-gray-500 mt-4">Tidak ada pengguna yang terdaftar.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>