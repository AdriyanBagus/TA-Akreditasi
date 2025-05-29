<x-app-layout>
    <x-slot name="header">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Penelitian Mahasiswa') }}
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
                            <th class="px-1 py-2 border">No</th>
                            <th class="px-4 py-2 border">Judul Penelitian</th>
                            <th class="px-4 py-2 border">Nama Mahasiswa</th>
                            <th class="px-4 py-2 border">Nama Pembimbing</th>
                            <th class="px-4 py-2 border">Tingkat</th>
                            <th class="px-4 py-2 border">Sumber Dana</th>
                            <th class="px-4 py-2 border">Kesesuaian Roadmap</th>
                            <th class="px-1 py-2 border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penelitian_mahasiswa as $penelitianmahasiswa)
                            <tr>
                                <td class="px-1 py-2 border">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border">{{ $penelitianmahasiswa->judul_penelitian }}</td>
                                <td class="px-4 py-2 border">{{ $penelitianmahasiswa->nama_mahasiswa }}</td>
                                <td class="px-4 py-2 border">{{ $penelitianmahasiswa->nama_pembimbing }}</td>
                                <td class="px-4 py-2 border">{{ $penelitianmahasiswa->tingkat }}</td>
                                <td class="px-4 py-2 border">{{ $penelitianmahasiswa->sumber_dana }}</td>
                                <td class="px-4 py-2 border">{{ $penelitianmahasiswa->kesesuaian_roadmap }}</td>
                                <td class="px-1 py-3 border flex flex-col items-center space-y-2">
                                    <!-- Tombol Edit -->
                                    <button 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $penelitianmahasiswa->id }}">
                                        Edit
                                    </button>

                                    <!-- Tombol Delete -->
                                    <form action="{{ route('pages.penelitian_mahasiswa.destroy', $penelitianmahasiswa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="exampleModal{{ $penelitianmahasiswa->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Penelitian Dosen</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('pages.penelitian_mahasiswa.update', $penelitianmahasiswa->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" hidden name="id" value="{{ $penelitianmahasiswa->id }}">
            
                                                <div class="mb-3">
                                                    <label for="judul_penelitian" class="form-label">Judul Penelitian:</label>
                                                    <input type="text" class="form-control" id="judul_penelitian" name="judul_penelitian" value="{{ $penelitianmahasiswa->judul_penelitian }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa:</label>
                                                    <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" value="{{ $penelitianmahasiswa->nama_mahasiswa }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama_pembimbing" class="form-label">Nama Pembimbing:</label>
                                                    <input type="text" class="form-control" id="nama_pembimbing" name="nama_pembimbing" value="{{ $penelitianmahasiswa->nama_pembimbing }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tingkat</label>
                                                    <select class="form-control" name="tingkat" value="{{ $penelitianmahasiswa->tingkat }}">
                                                      <option value="Internasional" {{ old('tingkat') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                                      <option value="Nasional" {{ old('tingkat') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                                      <option value="Lokal" {{ old('tingkat') == 'Lokal' ? 'selected' : '' }}>Lokal</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="sumber_dana" class="form-label">Sumber Dana:</label>
                                                    <input type="text" class="form-control" id="sumber_dana" name="sumber_dana" value="{{ $penelitianmahasiswa->sumber_dana }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kesesuaian Roadmap</label>
                                                    <select class="form-control" name="kesesuaian_roadmap" value="{{ $penelitianmahasiswa->kesesuaian_roadmap }}">
                                                      <option value="Sesuai" {{ old('kesesuaian_roadmap') == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                                                      <option value="Kurang Sesuai" {{ old('kesesuaian_roadmap') == 'Kurang Sesuai' ? 'selected' : '' }}>Kurang Sesuai</option>
                                                      <option value="Tidak sesuai" {{ old('kesesuaian_roadmap') == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                                                    </select>
                                                </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Edit</button>
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
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Profil Dosen</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('pages.penelitian_mahasiswa.add') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="judul_penelitian" class="form-label">Judul Penelitian:</label>
                                        <input type="text" class="form-control" id="judul_penelitian" name="judul_penelitian" value="{{ session('judul_penelitian') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa:</label>
                                        <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" value="{{ session('nama_mahasiswa') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_pembimbing" class="form-label">Nama Pembimbing:</label>
                                        <input type="text" class="form-control" id="nama_pembimbing" name="nama_pembimbing" value="{{ session('nama_pembimbing') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tingkat</label>
                                        <select class="form-control" name="tingkat" value="{{ old('tingkat', '') }}">
                                            <option value="Internasional" {{ old('tingkat') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                            <option value="Nasional" {{ old('tingkat') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                            <option value="Lokal" {{ old('tingkat') == 'Lokal' ? 'selected' : '' }}>Lokal</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sumber_dana" class="form-label">Sumber Dana:</label>
                                        <input type="text" class="form-control" id="sumber_dana" name="sumber_dana" value="{{ session('sumber_dana') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kesesuaian Roadmap</label>
                                        <select class="form-control" name="kesesuaian_roadmap" value="{{ old('kesesuaian_roadmap', '') }}">
                                            <option value="Sesuai" {{ old('kesesuaian_roadmap') == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                                            <option value="Kurang sesuai" {{ old('kesesuaian_roadmap') == 'Kurang Sesuai' ? 'selected' : '' }}>Kurang Sesuai</option>
                                            <option value="Tidak sesuai" {{ old('kesesuaian_roadmap') == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                                        </select>
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

                @if($penelitian_mahasiswa->isEmpty())
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
     
         modalTitle.textContent = '';
         // modalBodyInput.value = recipient;
    });
</x-app-layout>
