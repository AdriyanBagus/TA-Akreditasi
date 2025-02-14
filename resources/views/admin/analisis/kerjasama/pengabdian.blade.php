<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kerjasama Pengabdian Pada Masyarakat') }}
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
                                <a href="{{ route('pengabdian', ['sort_by' => 'nama_user', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Nama Prodi</a>
                            </th>
                            <th class="px-4 py-2 border">Lembaga Mitra</th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('pengabdian', ['sort_by' => 'nama_user', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Tingkat</a>
                            </th>
                            <th class="px-4 py-2 border">Judul Kegiatan</th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('pengabdian', ['sort_by' => 'nama_user', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Waktu/Durasi</a>
                            </th>
                            <th class="px-4 py-2 border">Realisasi Kerjasama</th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('pengabdian', ['sort_by' => 'nama_user', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">SPK</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengabdian as $data)
                            <tr>
                                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border">{{ $data->nama_user }}</td>
                                <td class="px-4 py-2 border">{{ $data->lembaga_mitra }}</td>
                                <td class="px-4 py-2 border">{{ $data->tingkat }}</td>
                                <td class="px-4 py-2 border">{{ $data->judul_kegiatan }}</td>
                                <td class="px-4 py-2 border">{{ $data->waktu_durasi }}</td>
                                <td class="px-4 py-2 border">{{ $data->realisasi_kerjasama }}</td>
                                <td class="px-4 py-2 border">{{ $data->spk }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($pengabdian->isEmpty())
                    <p class="text-center text-gray-500 mt-4">Tidak ada Kerjasama Pengabddian yang terdaftar.</p>
                @endif
            </div>
        </div>
    </div>

</x-app-layout>