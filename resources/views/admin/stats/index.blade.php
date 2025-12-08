<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Statistik - Admin MyPengembalianBarangKu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-stone-50 font-sans text-stone-800">

    <header class="bg-primary-900 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="p-2 bg-white/10 rounded-lg">
                        <svg class="w-6 h-6 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-sans font-bold tracking-wide">Admin Panel</h1>
                    </div>
                </a>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-sans font-bold text-stone-800 mb-6">Laporan Statistik & Dashboard</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Users -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-stone-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-stone-500 font-medium">Total Pengguna</h3>
                    <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-stone-800">{{ $totalUsers }}</p>
            </div>

            <!-- Total Items -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-stone-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-stone-500 font-medium">Total Barang Terlapor</h3>
                    <div class="p-2 bg-purple-50 rounded-lg text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-stone-800">{{ $totalItems }}</p>
            </div>

            <!-- Total Categories -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-stone-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-stone-500 font-medium">Total Kategori</h3>
                    <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                            </path>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-stone-800">{{ $totalCategories }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Chart Status Barang -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-stone-100">
                <h3 class="text-lg font-bold text-stone-800 mb-4">Distribusi Status Barang</h3>
                <div class="h-64 flex justify-center">
                    <canvas id="itemsStatusChart"></canvas>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-stone-100">
                <h3 class="text-lg font-bold text-stone-800 mb-4">Pengguna Baru</h3>
                <div class="overflow-y-auto max-h-64">
                    @forelse($recentUsers as $user)
                        <div class="flex items-center gap-3 mb-4 last:mb-0 border-b border-stone-50 pb-2 last:border-0">
                            <div
                                class="w-10 h-10 rounded-full bg-stone-200 flex items-center justify-center text-stone-500 font-bold overflow-hidden">
                                @if($user->photo_url)
                                    <img src="{{ asset('storage/' . $user->photo_url) }}" class="w-full h-full object-cover">
                                @else
                                    {{ substr($user->name, 0, 1) }}
                                @endif
                            </div>
                            <div>
                                <p class="font-medium text-stone-800">{{ $user->name }}</p>
                                <p class="text-xs text-stone-500">{{ $user->email }}</p>
                            </div>
                            <div class="ml-auto text-xs text-stone-400">
                                {{ $user->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @empty
                        <p class="text-stone-500 text-sm">Belum ada pengguna.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    <script>
        const ctx = document.getElementById('itemsStatusChart').getContext('2d');
        const itemsStatusChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Tersedia', 'Diklaim', 'Dikembalikan'],
                datasets: [{
                    label: 'Jumlah Barang',
                    data: [
                        {{ $itemsByStatus['available'] ?? 0 }},
                        {{ $itemsByStatus['claimed'] ?? 0 }},
                        {{ $itemsByStatus['returned'] ?? 0 }}
                    ],
                    backgroundColor: [
                        '#10b981', // Emerald 500
                        '#f59e0b', // Amber 500
                        '#3b82f6'  // Blue 500
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    </script>
</body>

</html>
