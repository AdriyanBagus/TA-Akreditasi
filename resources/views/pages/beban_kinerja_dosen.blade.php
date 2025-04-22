<x-app-layout>
    <x-slot name="header">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Beban Kinerja Dosen') }}
            </h2>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah
            </button>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg p-6">
                <table class="min-w-full bg-white border border-gray-500">
                    <thead>
                        <tr>
                            <th class="px-2 py-2 border">No</th>
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">NIDN</th>
                            <th class="px-4 py-2 border">Pengajaran</th>
                            <th class="px-4 py-2 border">Penelitian</th>
                            <th class="px-4 py-2 border">PKM</th>
                            <th class="px-4 py-2 border">Penunjang</th>
                            <th class="px-4 py-2 border">Jumlah sks</th>
                            <th class="px-4 py-2 border">Rata-rata sks</th>
                            <th class="px-4 py-2 border">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($beban_kinerja_dosen as $bebankinerjadosen)
                            <tr>
                                <td class="px-1 py-2 border">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border">{{ $bebankinerjadosen->nama }}</td>
                                <td class="px-4 py-2 border">{{ $bebankinerjadosen->nidn }}</td>
                                <td class="px-4 py-2 border">{{ $bebankinerjadosen->pengajaran }}</td>
                                <td class="px-4 py-2 border">{{ $bebankinerjadosen->penelitian }}</td>
                                <td class="px-4 py-2 border">{{ $bebankinerjadosen->pkm }}</td>
                                <td class="px-4 py-2 border">{{ $bebankinerjadosen->penunjang }}</td>
                                <td class="px-4 py-2 border">{{ $bebankinerjadosen->jumlah_sks }}</td>
                                <td class="px-4 py-2 border">{{ $bebankinerjadosen->rata_rata_sks }}</td>
                                <td class="px-1 py-3 border flex flex-col items-center space-y-2">
                                    <!-- Tombol Edit -->
                                    <button 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $evaluasipelaksanaan->id }}">
                                        Edit
                                </button>

                                    <!-- Tombol Delete -->
                                    <form action="{{ route('pages.beban_kinerja_dosen.destroy', $bebankinerjadosen->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="exampleModal{{ $bebankinerjadosen->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Beban Kinerja Dosen</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('pages.beban_kinerja_dosen.update', $bebankinerjadosen->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" hidden name="id" value="{{ $bebankinerjadosen->id }}">
            
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama:</label>
                                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $bebankinerjadosen->nama }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nidn" class="form-label">NIDN:</label>
                                                    <input type="text" class="form-control" id="nidn" name="nidn" value="{{ $bebankinerjadosen->nidn }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pengajaran</label>
                                                    <select class="form-control" name="pengajaran" value="{{ $bebankinerjadosen->pengajaran }}">
                                                      <option value="Program studi sendiri" {{ old('pengajaran') == 'Program studi sendiri' ? 'selected' : '' }}>Program studi sendiri</option>
                                                      <option value="Program studi lain" {{ old('pengajaran') == 'Program studi lain' ? 'selected' : '' }}>Program studi lain</option>
                                                      <option value="Program studi diluar PT" {{ old('pengajaran') == 'Program studi diluar PT' ? 'selected' : '' }}>Program studi diluar PT</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                  <label for="penelitian" class="form-label">Penelitian:</label>
                                                  <input type="text" class="form-control" id="penelitian" name="penelitian" value="{{ $bebankinerjadosen->penelitian }}" required>
                                                </div>
                                                <div class="mb-3">
                                                  <label for="pkm" class="form-label">PKM:</label>
                                                  <input type="text" class="form-control" id="pkm" name="pkm" value="{{ $bebankinerjadosen->pkm }}" required>
                                                </div>
                                                <div class="mb-3">
                                                  <label for="penunjang" class="form-label">Penunjang:</label>
                                                  <input type="text" class="form-control" id="penunjang" name="penunjang" value="{{ $bebankinerjadosen->penunjang }}" required>
                                                </div>
                                                <div class="mb-3">
                                                  <label for="jumlah_sks" class="form-label">Jumlah SKS:</label>
                                                  <input type="text" class="form-control" id="jumlah_sks" name="jumlah_sks" value="{{ $bebankinerjadosen->jumlah_sks }}" required>
                                                </div>
                                                <div class="mb-3">
                                                  <label for="rata_rata_sks" class="form-label">Rata Rata SKS per Semester:</label>
                                                  <input type="text" class="form-control" id="rata_rata_sks" name="rata_rata_sks" value="{{ $bebankinerjadosen->rata_rata_sks }}" required>
                                                </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>

                {{-- Modal --}}
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Beban Kinerja Dosen</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('pages.beban_kinerja_dosen.add') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama:</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nidn" class="form-label">NIDN:</label>
                                        <input type="text" class="form-control" id="nidn" name="nidn" value="{{ old('nidn') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pengajaran" class="form-label">Pengajaran:</label>
                                        <select class="form-control" id="pengajaran" name="pengajaran">
                                            <option value="Program studi sendiri" {{ old('pengajaran') == 'Program studi sendiri' ? 'selected' : '' }}>Program studi sendiri</option>
                                            <option value="Program studi lain" {{ old('pengajaran') == 'Program studi lain' ? 'selected' : '' }}>Program studi lain</option>
                                            <option value="Program studi diluar PT" {{ old('pengajaran') == 'Program studi diluar PT' ? 'selected' : '' }}>Program studi diluar PT</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="penelitian" class="form-label">Penelitian:</label>
                                        <input type="text" class="form-control" id="penelitian" name="penelitian" value="{{ old('penelitian') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pkm" class="form-label">PKM:</label>
                                        <input type="text" class="form-control" id="pkm" name="pkm" value="{{ old('pkm') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="penunjang" class="form-label">Penunjang:</label>
                                        <input type="text" class="form-control" id="penunjang" name="penunjang" value="{{ old('penunjang') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jumlah_sks" class="form-label">Jumlah SKS:</label>
                                        <input type="text" class="form-control" id="jumlah_sks" name="jumlah_sks" value="{{ old('jumlah_sks') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="rata_rata_sks" class="form-label">Rata Rata SKS per Semester:</label>
                                        <input type="text" class="form-control" id="rata_rata_sks" name="rata_rata_sks" value="{{ old('rata_rata_sks') }}" required>
                                    </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                  </div>
                  {{-- End Modal --}}

                @if ($beban_kinerja_dosen->isEmpty())
                    <p class="text-center text-gray-500 mt-4">Tidak ada data yang diinput.</p>
                @endif
            </div>
        </div>
    </div>
    <script>
        document.getElementById('exampleModal').addEventListener('show.bs.modal', function (event) {
         const button = event.relatedTarget; // Button yang memicu modal
         const modalTitle = this.querySelector('.modal-title');
         const modalBodyInput = this.querySelector('.modal-body input');
     
         modalTitle.textContent = 'Tambah Evaluasi Pelaksanaan ';
         // modalBodyInput.value = recipient;
    });
</x-app-layout>