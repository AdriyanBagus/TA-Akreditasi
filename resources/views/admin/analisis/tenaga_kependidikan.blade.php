<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile Tenaga Kependidikan') }}
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
                                <a href="{{ route('tenaga_kependidikan', ['sort_by' => 'nama_user', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Nama Prodi</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('tenaga_kependidikan', ['sort_by' => 'visi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Nama</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('tenaga_kependidikan', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">NIPY</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('tenaga_kependidikan', ['sort_by' => 'visi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Kualifikasi Pendidikan</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('tenaga_kependidikan', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Jabatan</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('tenaga_kependidikan', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Kesesuaian Bidang Kerja</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tenaga_kependidikan as $data)
                            <tr>
                                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border">{{ $data->nama_user }}</td>
                                <td class="px-4 py-2 border">{{ $data->nama }}</td>
                                <td class="px-4 py-2 border">{{ $data->nipy }}</td>
                                <td class="px-4 py-2 border">{{ $data->kualifikasi_pendidikan }}</td>
                                <td class="px-4 py-2 border">{{ $data->jabatan }}</td>
                                <td class="px-4 py-2 border">{{ $data->kesesuaian_bidang_kerja }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($tenaga_kependidikan->isEmpty())
                    <p class="text-center text-gray-500 mt-4">Tidak ada pengguna yang terdaftar.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>