<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Penelitian Mahasiswa') }}
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
                                <a href="{{ route('penelitian_mahasiswa', ['sort_by' => 'nama_user', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Nama Prodi </a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('penelitian_mahasiswa', ['sort_by' => 'nama', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Judul Penelitian</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('penelitian_mahasiswa', ['sort_by' => 'visi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Nama Mahasiswa</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('penelitian_mahasiswa', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Nama Pembimbing</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('penelitian_mahasiswa', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Tingkat</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('penelitian_mahasiswa', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Sumber Dana</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('penelitian_mahasiswa', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Kesesuaian Roadmap</a>
                            </th> 
                    </thead>
                    <tbody>
                        @foreach($penelitian_mahasiswa as $data)
                            <tr>
                                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border">{{ $data->nama_user }}</td>
                                <td class="px-4 py-2 border">{{ $data->judul_penelitian }}</td>
                                <td class="px-4 py-2 border">{{ $data->nama_mahasiswa }}</td>
                                <td class="px-4 py-2 border">{{ $data->nama_pembimbing }}</td>
                                <td class="px-4 py-2 border">{{ $data->tingkat }}</td>
                                <td class="px-4 py-2 border">{{ $data->sumber_dana }}</td>
                                <td class="px-4 py-2 border">{{ $data->kesesuaian_roadmap }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($penelitian_mahasiswa->isEmpty())
                    <p class="text-center text-gray-500 mt-4">Tidak ada pengguna yang terdaftar.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>