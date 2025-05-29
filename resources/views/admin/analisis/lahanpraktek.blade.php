<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lahan Praktek') }}
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
                                <a href="{{ route('lahan_praktek', ['sort_by' => 'nama_user', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Nama Prodi</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('lahan_praktek', ['sort_by' => 'visi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Lahan Praktek</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('lahan_praktek', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Akreditasi</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('lahan_praktek', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Kesesuaian Bidang Keilmuan</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('lahan_praktek', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Jumlah Mahasiswa</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('lahan_praktek', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Daya Tampung Mahasiswa</a>
                            </th>
                            <th class="px-4 py-2 border">
                                <a href="{{ route('lahan_praktek', ['sort_by' => 'misi', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">Kontribusi Lahan Praktek</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lahan_praktek as $data)
                            <tr>
                                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border">{{ $data->nama_user }}</td>
                                <td class="px-4 py-2 border">{{ $data->lahan_praktek }}</td>
                                <td class="px-4 py-2 border">{{ $data->akreditasi }}</td>
                                <td class="px-4 py-2 border">{{ $data->kesesuaian_bidang_keilmuan }}</td>
                                <td class="px-4 py-2 border">{{ $data->jumlah_mahasiswa }}</td>
                                <td class="px-4 py-2 border">{{ $data->daya_tampung_mahasiswa }}</td>
                                <td class="px-4 py-2 border">{{ $data->kontribusi_lahan_praktek }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($lahan_praktek->isEmpty())
                    <p class="text-center text-gray-500 mt-4">Tidak ada pengguna yang terdaftar.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>