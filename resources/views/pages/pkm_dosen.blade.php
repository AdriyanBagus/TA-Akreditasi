<x-app-layout>
    <x-slot name="header">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('PKM Dosen') }}
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
                            <th class="px-2 py-2 border text-xs">No</th>
                            <th class="px-4 py-2 border text-xs">Judul PKM</th>
                            <th class="px-4 py-2 border text-xs">Nama Dosen</th>
                            <th class="px-4 py-2 border text-xs">Nama Mahasiswa</th>
                            <th class="px-4 py-2 border text-xs">Tingkat</th>
                            <th class="px-4 py-2 border text-xs">Sumber Dana</th>
                            <th class="px-4 py-2 border text-xs">Kesesuaian Roadmap</th>
                            <th class="px-4 py-2 border text-xs">Bentuk Integrasi</th>
                            <th class="px-4 py-2 border text-xs">Mata Kuliah</th>
                            <th class="px-4 py-2 border text-xs">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pkm_dosen as $pkmdosen)
                            <tr>
                                <td class="px-1 py-2 border text-xs">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border text-xs">{{ $pkmdosen->judul_pkm }}</td>
                                <td class="px-4 py-2 border text-xs">{!! nl2br(e($pkmdosen->dosen)) !!}</td>
                                <td class="px-4 py-2 border text-xs">{!! nl2br(e($pkmdosen->mahasiswa)) !!}</td>
                                <td class="px-4 py-2 border text-xs">{{ $pkmdosen->tingkat }}</td>
                                <td class="px-4 py-2 border text-xs">{{ $pkmdosen->sumber_dana }}</td>
                                <td class="px-4 py-2 border text-xs">{{ $pkmdosen->kesesuaian_roadmap }}</td>
                                <td class="px-4 py-2 border text-xs">{{ $pkmdosen->bentuk_integrasi }}</td>
                                <td class="px-4 py-2 border text-xs">{{ $pkmdosen->mata_kuliah }}</td>
                                <td class="px-1 py-3 border flex flex-col items-center space-y-2">
                                    <!-- Tombol Edit -->
                                    <button 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-xs" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $pkmdosen->id }}">
                                        Edit
                                </button>

                                    <!-- Tombol Delete -->
                                    <form action="{{ route('pages.pkm_dosen.destroy', $pkmdosen->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs" >
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="exampleModal{{ $pkmdosen->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">PKM Mahasiswa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('pages.pkm_dosen.update', $pkmdosen->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" hidden name="id" value="{{ $pkmdosen->id }}">

                                                <div class="mb-3">
                                                    <label for="judul_pkm" class="form-label">Judul PKM:</label>
                                                    <textarea class="form-control" id="judul_pkm" name="judul_pkm" required>{{  $pkmdosen->judul_pkm }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="dosen" class="form-label">Nama Dosen:</label>
                                                    <textarea class="form-control" id="dosen" name="dosen" required>{{  $pkmdosen->dosen }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="mahasiswa" class="form-label">Nama Mahasiswa:</label>
                                                    <textarea class="form-control" id="mahasiswa" name="mahasiswa" required>{{  $pkmdosen->mahasiswa }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tingkat:</label>
                                                    <select class="form-control" name="tingkat" value="{{ $pkmdosen->tingkat }}">
                                                      <option value="internasional" {{ old('tingkat') == 'internasional' ? 'selected' : '' }}>Internasional</option>
                                                      <option value="nasional" {{ old('tingkat') == 'nasional' ? 'selected' : '' }}>Nasional</option>
                                                      <option value="lokal" {{ old('tingkat') == 'lokal' ? 'selected' : '' }}>Lokal</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="sumber_dana" class="form-label">Sumber Dana:</label>
                                                    <input type="text" class="form-control" id="sumber_dana" name="sumber_dana" placeholder="PT, Mandiri, Luar PT sebutkan"  value="{{  $pkmdosen->sumber_dana }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kesesuaian Roadmap:</label>
                                                    <select class="form-control" name="kesesuaian_roadmap" value="{{ $pkmdosen->kesesuaian_roadmap }}">
                                                      <option value="sesuai" {{ old('kesesuaian_roadmap') == 'sesuai' ? 'selected' : '' }}>Sesuai</option>
                                                      <option value="kurang sesuai" {{ old('kesesuaian_roadmap') == 'kurang sesuai' ? 'selected' : '' }}>Kurang Sesuai</option>
                                                      <option value="tidak sesuai" {{ old('kesesuaian_roadmap') == 'tidak sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="bentuk_integrasi" class="form-label">Bentuk Integrasi:</label>
                                                    <input type="text" class="form-control" id="bentuk_integrasi" name="bentuk_integrasi" value="{{  $pkmdosen->bentuk_integrasi }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="mata_kuliah" class="form-label">Mata Kuliah:</label>
                                                    <input type="text" class="form-control" id="mata_kuliah" name="mata_kuliah" value="{{  $pkmdosen->mata_kuliah }}" required>
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
                                <h5 class="modal-title" id="exampleModalLabel">pkm_mahasiswa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('pages.pkm_dosen.add') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="judul_pkm" class="form-label">Judul PKM:</label>
                                        <textarea class="form-control" id="judul_pkm" name="judul_pkm" required>{{  session('judul_pkm') }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dosen" class="form-label">Nama Dosen:</label>
                                        <textarea class="form-control" id="dosen" name="dosen" required>{{  session('dosen') }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mahasiswa" class="form-label">Nama Mahasiswa:</label>
                                        <textarea class="form-control" id="mahasiswa" name="mahasiswa" required>{{  session('mahasiswa') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Tingkat:</label>
                                        <select class="form-control" name="tingkat">
                                          <option value="internasional" {{ old('tingkat') == 'internasional' ? 'selected' : '' }}>Internasional</option>
                                          <option value="nasional" {{ old('tingkat') == 'nasional' ? 'selected' : '' }}>Nasional</option>
                                          <option value="lokal" {{ old('tingkat') == 'lokal' ? 'selected' : '' }}>Lokal</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sumber_dana" class="form-label">Sumber Dana:</label>
                                        <input type="text" class="form-control" id="sumber_dana" name="sumber_dana" placeholder="PT, Mandiri, Luar PT sebutkan"  value="{{  session('sumber_dana') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kesesuaian Roadmap:</label>
                                        <select class="form-control" name="kesesuaian_roadmap">
                                          <option value="sesuai" {{ old('kesesuaian_roadmap') == 'sesuai' ? 'selected' : '' }}>Sesuai</option>
                                          <option value="kurang sesuai" {{ old('kesesuaian_roadmap') == 'kurang sesuai' ? 'selected' : '' }}>Kurang Sesuai</option>
                                          <option value="tidak sesuai" {{ old('kesesuaian_roadmap') == 'tidak sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="bentuk_integrasi" class="form-label">Bentuk Integrasi:</label>
                                        <input type="text" class="form-control" id="bentuk_integrasi" name="bentuk_integrasi" value="{{  session('bentuk_integrasi') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mata_kuliah" class="form-label">Mata Kuliah:</label>
                                        <input type="text" class="form-control" id="mata_kuliah" name="mata_kuliah" value="{{  session('mata_kuliah') }}" required>
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

                @if($pkm_dosen->isEmpty())
                    <p class="text-center text-gray-500 mt-4">Tidak ada data yang diinput.</p>
                @endif
            </div>
        </div>
    </div>
    <script>
        document.getElementById('exampleModal').addEventListener('show.bs.modal', function (event) {
         const button = event.relatedTarget; // Button yang memicu modal
         const recipient = button.getAttribute('data-whatever'); // Ambil data dari button
         const modalTitle = this.querySelector('.modal-title');
         const modalBodyInput = this.querySelector('.modal-body input');
     
         modalTitle.textContent = 'Tambah PKM Dosen ';
         // modalBodyInput.value = recipient;
    });
    </script>
</x-app-layout>