<x-app-layout>
    <x-slot name="header">
        <div class="relative flex items-center">
            <!-- Tombol Scroll Kiri -->
            <button id="scrollLeft" class="absolute left-[-10px] z-10 bg-white-700 text-white px-3 py-1 rounded-full">
                ◀
            </button>

            <!-- Navbar Scrollable -->
            <div id="navScroll"
                class="hidden sm:-my-px sm:ms-10 sm:flex overflow-x-auto whitespace-nowrap space-x-7 max-w-full scrollbar-hide scroll-container">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Tingkat Akreditasi') }}
                </x-nav-link>
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Visi dan Misi') }}
                </x-nav-link>
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
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
            </div>

            <!-- Tombol Scroll Kanan -->
            <button id="scrollRight" class="absolute right-[-40px] z-10 bg-white-700 text-white px-3 py-1 rounded-full">
                ▶
            </button>
        </div>
    </x-slot>

    <!-- Container untuk Chart -->
    <div class="chart-container">
        <canvas id="myChart"></canvas>
    </div>

    <!-- Link ke Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.getElementById("scrollLeft").addEventListener("click", function () {
            document.getElementById("navScroll").scrollBy({ left: -200, behavior: "smooth" });
        });

        document.getElementById("scrollRight").addEventListener("click", function () {
            document.getElementById("navScroll").scrollBy({ left: 200, behavior: "smooth" });
        });

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Tingkat A', 'Tingkat B', 'Tingkat C'],
                datasets: [{
                    label: 'Tingkat Akreditasi',
                    data: [1, 3, 2],
                    backgroundColor: ['#ffeb3b', '#8bc34a', '#4caf50'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#ffffff'
                        }
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tingkat akreditasi',
                            color: '#ffffff'
                        },
                        ticks: {
                            color: '#ffffff'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Prodi',
                            color: '#ffffff'
                        },
                        ticks: {
                            color: '#ffffff'
                        }
                    }
                }
            }
        });
    </script>

    <!-- Tambahkan CSS -->
    <style>
        .chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 1300px;
            height: 600px;
            margin: 20px auto;
            background-color: #1e293b;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3);
        }

        canvas {
            width: 100% !important;
            height: 100% !important;
        }

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
</x-app-layout>