<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile Dosen Tidak Tetap') }}
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
                                <a href="{{ route('profile_dosen_tidak_tetap', ['sort_by' => 'nama_user', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Nama Prodi </a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('profile_dosen_tidak_tetap', ['sort_by' => 'nama', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Nama Dosen</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('profile_dosen_tidak_tetap', ['sort_by' => 'visi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Asal Instansi</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('profile_dosen_tidak_tetap', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Kualifikasi pendidikan</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('profile_dosen_tidak_tetap', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Sertifikat pendidik profesional</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('profile_dosen_tidak_tetap', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Sertifikat Kompetensi</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('profile_dosen_tidak_tetap', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Bidang Keahlian</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('profile_dosen_tidak_tetap', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Kesesuaian Bidang Ilmu Prodi</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($profile_dosen_tidak_tetap as $data)
                            <tr>
                                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border">{{ $data->nama_user }}</td>
                                <td class="px-4 py-2 border">{{ $data->nama }}</td>
                                <td class="px-4 py-2 border">{{ $data->asal_instansi }}</td>
                                <td class="px-4 py-2 border">{{ $data->kualifikasi_pendidikan }}</td>
                                <td class="px-4 py-2 border">{{ $data->sertifikasi_pendidik_profesional }}</td>
                                <td class="px-4 py-2 border">{{ $data->sertifikat_kompetensi }}</td>
                                <td class="px-4 py-2 border">{{ $data->bidang_keahlian }}</td>
                                <td class="px-4 py-2 border">{{ $data->kesesuaian_bidang_ilmu_prodi }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($profile_dosen_tidak_tetap->isEmpty())
                    <p class="text-center text-gray-500 mt-4">Tidak ada pengguna yang terdaftar.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>