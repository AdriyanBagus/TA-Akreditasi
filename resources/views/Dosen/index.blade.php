<x-app-layout>
    <div class="py-8 px-4 max-w-3xl mx-auto" x-data="{ open: false }">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($data->isNotEmpty())
            @php $dosen = $data->first(); @endphp

            <div class="bg-white shadow-lg rounded-lg p-4 text-center">
                <div class="mb-4">
                    <h3 class="text-xl font-bold text-gray-800">{{ $dosen->nama_lengkap }}</h3>
                    <p class="text-sm text-gray-500">{{ $dosen->user->name ?? '-' }}</p>
                </div>

                <div class="mt-4 space-y-2 text-left">
                    <p><strong class="text-gray-700">NIDN:</strong> {{ $dosen->nidn }}</p>
                    <p><strong class="text-gray-700">Asal Prodi:</strong> {{ $dosen->user->name ?? '-' }}</p>
                </div>

                <div class="mt-6 flex justify-center gap-4">
                    <!-- Button to open modal -->
                    <button @click="open = true"
                        class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
                        Edit
                    </button>

                    <!-- Tombol Hapus pakai SweetAlert -->
                    <button type="button" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition"
                        onclick="hapusData({{ $dosen->id }})">
                        Hapus
                    </button>

                    <!-- Form tersembunyi untuk submit -->
                    <form id="hapus-form-{{ $dosen->id }}" action="{{ route('dosen.destroy', $dosen->id) }}" method="POST"
                        style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                </div>
            </div>

            <!-- MODAL EDIT -->
            <div x-show="open" class="fixed inset-0 z-50 bg-black/30 backdrop-blur-sm flex items-center justify-center">

                <div @click.away="open = false" class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
                    <h2 class="text-lg font-semibold mb-4">Edit Dosen</h2>
                    <form method="POST" action="{{ route('dosen.update', $dosen->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ $dosen->nama_lengkap }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">NIDN</label>
                            <input type="text" name="nidn" value="{{ $dosen->nidn }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Asal Prodi</label>
                            <select name="asal_prodi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                required>
                                @foreach (\App\Models\User::where('usertype', 'user')->pluck('name', 'id') as $id => $name)
                                    <option value="{{ $id }}" {{ $dosen->asal_prodi == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" @click="open = false"
                                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">Batal</button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

        @else
            <div class="text-center text-gray-500 py-12">
                Belum ada data dosen. <br>
                <a href="{{ route('dosen.create') }}" class="mt-4 inline-block text-blue-600 hover:underline">
                    + Tambah Dosen
                </a>
            </div>
        @endif
    </div>

    <script>
        function hapusData(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data dosen akan dihapus permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('hapus-form-' + id).submit();
                }
            });
        }
    </script>

</x-app-layout>