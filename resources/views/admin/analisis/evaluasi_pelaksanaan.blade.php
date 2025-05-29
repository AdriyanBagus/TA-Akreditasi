<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluasi Pelaksanaan') }}
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
                                <a href="{{ route('evaluasi_pelaksanaan', ['sort_by' => 'nama_user', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Nama Prodi</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('evaluasi_pelaksanaan', ['sort_by' => 'visi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Nomer PTK</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('evaluasi_pelaksanaan', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Kategori PTK</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('evaluasi_pelaksanaan', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Rencana Penyelesaian</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('evaluasi_pelaksanaan', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Realisasi Perbaikan</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('evaluasi_pelaksanaan', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Penanggung Jawab Perbaikan</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($evaluasi_pelaksanaan as $data)
                            <tr>
                                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border">{{ $data->nama_user }}</td>
                                <td class="px-4 py-2 border">{{ $data->nomor_ptk }}</td>
                                <td class="px-4 py-2 border">{{ $data->kategori_ptk }}</td>
                                <td class="px-4 py-2 border">{{ $data->rencana_penyelesaian }}</td>
                                <td class="px-4 py-2 border">{{ $data->realisasi_perbaikan }}</td>
                                <td class="px-4 py-2 border">{{ $data->penanggungjawab_perbaikan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($evaluasi_pelaksanaan->isEmpty())
                    <p class="text-center text-gray-500 mt-4">Tidak ada pengguna yang terdaftar.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>