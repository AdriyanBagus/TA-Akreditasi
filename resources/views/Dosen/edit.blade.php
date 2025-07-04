<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Info Dosen') }}
        </h2>
    </x-slot>

    <h1>Edit Dosen</h1>

    <form method="POST" action="{{ route('dosen.update', $dosen->id) }}">
        @csrf @method('PUT')
        <label>Asal Prodi</label>
        <input type="text" name="asal_prodi" value="{{ $dosen->asal_prodi }}" required>
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="{{ $dosen->nama_lengkap }}" required>
        <label>NIDN</label>
        <input type="text" name="nidn" value="{{ $dosen->nidn }}" required>
        <button type="submit">Update</button>
    </form>

</x-app-layout>