<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 md:gap-6">

            <!-- Kiri: Tombol Kembali + Judul -->
            <div class="flex items-center gap-3">
                <!-- Tombol Kembali -->
                <a href="javascript:history.back()"
                    class="inline-flex items-center bg-gray-100 hover:bg-gray-200 text-black font-medium px-3 py-1.5 rounded-lg shadow-sm transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>

                <!-- Judul -->
                <h2 class="text-xl font-semibold text-gray-800">
                    {{ __('Lahan Praktek') }}
                </h2>
            </div>

            <!-- Kanan: Dropdown Filter Tahun Akademik -->
            <form method="GET" action="{{ route('pelaksana_ta') }}" class="flex flex-col md:flex-row md:items-center gap-2">
                <label for="tahun" class="text-sm font-medium text-gray-700">Tahun Akademik:</label>
                <select name="tahun" id="tahun" onchange="this.form.submit()"
                    class="w-64 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-700 bg-white">
                    @foreach($tahunList as $tahun)
                        <option value="{{ $tahun->id }}" {{ $tahunTerpilih == $tahun->id ? 'selected' : '' }}>
                            {{ $tahun->tahun }} {{ $tahun->is_active ? '(Aktif)' : '' }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
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

    <div class="py-4">
    <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl rounded-lg p-6">
            <h3 class="text-lg font-bold mb-4">Komentar</h3>

            <ul class="list-group mb-4">
                @if($komentar->isNotEmpty())
                    @foreach($komentar as $value)
                        <li class="list-group-item d-flex justify-content-between align-items-start align-items-center">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Prodi: {{ $value->user->name }}</div>
                                <div>Komentar: {{ $value->komentar }}</div>
                                <small class="text-muted">Ditambahkan pada: {{ $value->created_at }}</small>
                            </div>
                            <form action="{{ route('admin.komentar.destroy', $value->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus komentar ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger ms-3" title="Hapus Komentar">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </li>
                    @endforeach
                @else
                    <li class="list-group-item text-center text-muted">Belum ada komentar.</li>
                @endif
            </ul>

            <form action="{{ route('admin.komentar') }}" method="POST">
                @csrf
                <input type="hidden" name="nama_tabel" value="{{ $tabel }}">

                <div class="mb-3">
                    <label for="prodi_id" class="form-label">Pilih Prodi:</label>
                    <select class="form-select" id="prodi_id" name="prodi_id" required>
                        <option value="">Pilih Prodi</option>
                        @foreach($prodi as $prodi)
                            <option value="{{ $prodi->id }}">{{ $prodi->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="komentar" class="form-label">Komentar:</label>
                    <textarea class="form-control" id="komentar" name="komentar" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>
</div>
</x-app-layout>