<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('PKM Dosen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-1">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg p-6">
                <table class="min-w-full bg-white border border-gray-500">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('pkm_dosen', ['sort_by' => 'nama_user', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Nama Prodi</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('pkm_dosen', ['sort_by' => 'visi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Judul PKM</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('pkm_dosen', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Dosen</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('pkm_dosen', ['sort_by' => 'visi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Mahasiswa</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('pkm_dosen', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Tingkat</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('pkm_dosen', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Sumber Dana</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('pkm_dosen', ['sort_by' => 'visi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Kesesuaian Roadmap</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('pkm_dosen', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Bentuk Integritas</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('pkm_dosen', ['sort_by' => 'visi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Mata Kuliah</a>
                            </th>
                    </thead>
                    <tbody>
                        @foreach($pkm_dosen as $data)
                            <tr>
                                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border">{{ $data->nama_user }}</td>
                                <td class="px-4 py-2 border">{{ $data->judul_pkm }}</td>
                                <td class="px-4 py-2 border">{{ $data->dosen }}</td>
                                <td class="px-4 py-2 border">{{ $data->mahasiswa }}</td>
                                <td class="px-4 py-2 border">{{ $data->tingkat }}</td>
                                <td class="px-4 py-2 border">{{ $data->sumber_dana }}</td>
                                <td class="px-4 py-2 border">{{ $data->kesesuaian_roadmap }}</td>
                                <td class="px-4 py-2 border">{{ $data->bentuk_integrasi }}</td>
                                <td class="px-4 py-2 border">{{ $data->mata_kuliah }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($pkm_dosen->isEmpty())
                    <p class="text-center text-gray-500 mt-4">Tidak ada pengguna yang terdaftar.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>