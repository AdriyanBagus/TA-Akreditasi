<div class="relative flex items-center">
    <!-- Tombol Scroll Kiri -->
    <button id="scrollLeft" class="absolute left-[-10px] z-10 bg-white-700 text-white px-3 py-1 rounded-full">
        ◀
    </button>

    <div id="navScroll"
        class="hidden sm:-my-px sm:ms-10 sm:flex overflow-x-auto whitespace-nowrap space-x-7 max-w-full scrollbar-hide scroll-container">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Tingkat Akreditasi') }}
        </x-nav-link>
        <x-nav-link :href="route('visimisi')" :active="request()->routeIs('dashboard')">
            {{ __('Visi dan Misi') }}
        </x-nav-link>
        <x-nav-link :href="route('pendidikan')" :active="request()->routeIs('dashboard')">
            {{ __('Kerjasama') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Ketersediaan Dokumen PS/Bagian') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Pelaksanaan Penjaminan Mutu') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Profile Dosen') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Beban Kinerja Dosen') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Profil Dosen tidak tetap') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Pelaksanaan TA') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Wahana/Lahan Praktek') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Kinerja DTPS') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Profil Tenaga Kependidikan') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Rekognisi tenaga kependidikan') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Keuangan') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Sarana dan Prasarana') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Penelitian Dosen Program Studi') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Penelitian mahasiswa diluar TA Program Studi') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Publikasi Karya Ilmiah Hasil Penelitian Program Studi') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Luaran Karya Ilmiah Hasil penelitian Program Studi') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Sitasi luaran penelitian Dosen Program Studi') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('PKM Dosen Program Studi') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('PMM Mahasiswa Program Studi') }}
        </x-nav-link>

    </div>

    <!-- Tombol Scroll Kanan -->
    <button id="scrollRight" class="absolute right-[-40px] z-10 bg-white-700 text-white px-3 py-1 rounded-full">
        ▶
    </button>

    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scroll-container {
            padding: 10px 40px;
            /* Tambah padding kiri dan kanan agar tidak terlalu rapat */
        }

        button {
            cursor: pointer;
            transition: background 0.3s;
        }
    </style>
</div>