<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Luaran Karya Ilmiah PKM') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg p-6">
                <table class="min-w-full bg-white border border-gray-500">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('luaran_ki_pkm', ['sort_by' => 'nama_user', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Nama Prodi</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('luaran_ki_pkm', ['sort_by' => 'judul_kegiatan_pkm', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Judul Kegiatan PKM</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('luaran_ki_pkm', ['sort_by' => 'judul_karya', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Judul Karya</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('luaran_ki_pkm', ['sort_by' => 'dosen', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Dosen</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('luaran_ki_pkm', ['sort_by' => 'mahasiswa', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Mahasiswa</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('luaran_ki_pkm', ['sort_by' => 'penyusun_utama', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Penyusun Utama</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('luaran_ki_pkm', ['sort_by' => 'jenis', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Jenis</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('luaran_ki_pkm', ['sort_by' => 'nomor_karya', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Nomor Karya</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('luaran_ki_pkm', ['sort_by' => 'keterangan', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Keterangan</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($luaran_ki_pkm as $data)
                            <tr>
                                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border">{{ $data->nama_user }}</td>
                                <td class="px-4 py-2 border">{{ $data->judul_kegiatan_pkm }}</td>
                                <td class="px-4 py-2 border">{{ $data->judul_karya }}</td>
                                <td class="px-4 py-2 border">{{ $data->dosen }}</td>
                                <td class="px-4 py-2 border">{{ $data->mahasiswa }}</td>
                                <td class="px-4 py-2 border">{{ $data->penyusun_utama }}</td>
                                <td class="px-4 py-2 border">{{ $data->jenis }}</td>
                                <td class="px-4 py-2 border">{{ $data->nomor_karya }}</td>
                                <td class="px-4 py-2 border">{{ $data->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($luaran_ki_pkm->isEmpty())
                    <p class="text-center text-gray-500 mt-4">Tidak ada pengguna yang terdaftar.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>