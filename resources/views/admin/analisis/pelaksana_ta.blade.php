<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pelaksanaan TA') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg p-6">
                <table class="min-w-full bg-white border border-gray-500">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('pelaksana_ta', ['sort_by' => 'nama_user', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Nama Prodi </a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('pelaksana_ta', ['sort_by' => 'nama', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Nama</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('pelaksana_ta', ['sort_by' => 'visi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">NIDN</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('pelaksana_ta', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Bimbingan Mahasiswa</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('pelaksana_ta', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Rata-rata Jumlah Bimbingan</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('pelaksana_ta', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Bimbingan Mahasiswa Program Studi Lain</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('pelaksana_ta', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Rata-rata jumlah bimbingan seluruh Program Studi</a>
                            </th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pelaksana_ta as $data)
                            <tr>
                                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border">{{ $data->nama_user }}</td>
                                <td class="px-4 py-2 border">{{ $data->nama }}</td>
                                <td class="px-4 py-2 border">{{ $data->nidn }}</td>
                                <td class="px-4 py-2 border">{{ $data->bimbingan_mahasiswa_ps }}</td>
                                <td class="px-4 py-2 border">{{ $data->rata_rata_jumlah_bimbingan }}</td>
                                <td class="px-4 py-2 border">{{ $data->bimbingan_mahasiswa_ps_lain }}</td>
                                <td class="px-4 py-2 border">{{ $data->rata_rata_jumlah_bimbingan_seluruh_ps }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($pelaksana_ta->isEmpty())
                    <p class="text-center text-gray-500 mt-4">Tidak ada pengguna yang terdaftar.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>