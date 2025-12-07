<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Barang - MyPengembalianBarangKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .success-animation {
            animation: successPop 0.6s ease-out;
        }

        @keyframes successPop {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .detail-card {
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="min-h-screen">
    
    {{-- Header --}}
    <header class="bg-white/10 backdrop-blur-md text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <div>
                        <h1 class="text-xl font-bold">MyPengembalianBarangKu</h1>
                        <p class="text-sm text-white/80">Detail Barang</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-white/80 capitalize">{{ Auth::user()->role }}</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition">
                        Dashboard
                    </a>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            
            {{-- Success Alert --}}
            @if(session('success'))
                <div class="success-animation bg-green-500 text-white px-6 py-4 rounded-xl shadow-2xl mb-6 flex items-center gap-4">
                    <div class="bg-white/20 p-3 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-lg">{{ session('success') }}</p>
                        <p class="text-sm text-green-100">Barang telah tersimpan dalam sistem</p>
                    </div>
                </div>
            @endif

            {{-- Detail Card --}}
            <div class="detail-card bg-white rounded-2xl shadow-2xl overflow-hidden">
                
                {{-- Header Card --}}
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-6">
                    <div class="flex items-center gap-3">
                        <div class="bg-white/20 p-3 rounded-full">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold">Detail Barang yang Dilaporkan</h2>
                            <p class="text-sm text-blue-100">ID Barang: #{{ $item->item_id }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        
                        {{-- Left Column: Image --}}
                        <div>
                            <div class="bg-gray-100 rounded-xl overflow-hidden shadow-lg">
                                <img 
                                    src="{{ $item->getPhotoDisplayUrl() }}" 
                                    alt="{{ $item->item_name }}"
                                    class="w-full h-auto object-cover"
                                    onerror="this.src='https://via.placeholder.com/400x300?text=Foto+Tidak+Tersedia'"
                                >
                            </div>
                            <div class="mt-4 bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                                <p class="text-xs font-semibold text-blue-800 mb-1">📁 Lokasi File:</p>
                                <p class="text-xs text-blue-600 font-mono break-all">
                                    storage/{{ $item->photo_url }}
                                </p>
                            </div>
                        </div>

                        {{-- Right Column: Details --}}
                        <div class="space-y-6">
                            
                            {{-- Status Badge --}}
                            <div class="flex items-center gap-2">
                                <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                                    ✓ {{ ucfirst($item->status) }}
                                </span>
                                <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">
                                    {{ $item->category->category_name }}
                                </span>
                            </div>

                            {{-- Nama Barang --}}
                            <div>
                                <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Nama Barang</label>
                                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $item->item_name }}</p>
                            </div>

                            {{-- Deskripsi --}}
                            <div>
                                <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Deskripsi</label>
                                <p class="text-gray-700 mt-1 leading-relaxed">{{ $item->description }}</p>
                            </div>

                            {{-- Info Grid --}}
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="text-xs font-semibold text-gray-500 uppercase">Lokasi Penemuan</label>
                                    <p class="text-gray-800 font-semibold mt-1">📍 {{ $item->location_found }}</p>
                                </div>
                                
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="text-xs font-semibold text-gray-500 uppercase">Kategori</label>
                                    <p class="text-gray-800 font-semibold mt-1">🏷️ {{ $item->category->category_name }}</p>
                                </div>
                                
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="text-xs font-semibold text-gray-500 uppercase">Tanggal Ditemukan</label>
                                    <p class="text-gray-800 font-semibold mt-1">📅 {{ date('d/m/Y', strtotime($item->date_found)) }}</p>
                                </div>
                                
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="text-xs font-semibold text-gray-500 uppercase">Waktu Ditemukan</label>
                                    <p class="text-gray-800 font-semibold mt-1">🕐 {{ date('H:i', strtotime($item->time_found)) }}</p>
                                </div>
                            </div>

                            {{-- Nomor Telepon --}}
                            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
                                <label class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-2 block">Kontak Pelapor</label>
                                <div class="flex items-center gap-3">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase">Nomor Telepon</p>
                                        <a href="tel:{{ $item->phone }}" class="text-lg font-bold text-green-700 hover:text-green-800 hover:underline">
                                            {{ $item->phone }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- Pelapor Info --}}
                            <div class="border-t pt-4">
                                <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Dilaporkan Oleh</label>
                                <div class="flex items-center gap-3 mt-2">
                                    <div class="bg-gradient-to-br from-blue-500 to-purple-600 w-12 h-12 rounded-full flex items-center justify-center text-white font-bold">
                                        {{ substr($item->reporter->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $item->reporter->name }}</p>
                                        <p class="text-sm text-gray-500 capitalize">{{ $item->reporter->role }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="mt-8 pt-6 border-t">
                        @if(Auth::id() === $item->reporter_id)
                            {{-- Tombol Edit dan Hapus untuk Owner --}}
                            <div class="flex gap-4 mb-4">
                                <a 
                                    href="{{ route('items.edit', $item->item_id) }}"
                                    class="flex-1 bg-gradient-to-r from-yellow-500 to-orange-500 text-white py-3 rounded-lg font-semibold text-center hover:shadow-lg transition"
                                >
                                    ✏️ Edit Barang
                                </a>
                                <form 
                                    action="{{ route('items.destroy', $item->item_id) }}" 
                                    method="POST" 
                                    class="flex-1"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini? Tindakan ini tidak dapat dibatalkan.');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit"
                                        class="w-full bg-gradient-to-r from-red-500 to-red-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition"
                                    >
                                        🗑️ Hapus Barang
                                    </button>
                                </form>
                            </div>
                        @elseif(Auth::user()->isAdmin())
                            {{-- Tombol Hapus untuk Admin (untuk postingan user lain) --}}
                            <div class="mb-4">
                                <form 
                                    action="{{ route('items.destroy', $item->item_id) }}" 
                                    method="POST" 
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus postingan ini sebagai admin? Tindakan ini tidak dapat dibatalkan.');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit"
                                        class="w-full bg-gradient-to-r from-red-500 to-red-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition"
                                    >
                                        🗑️ Hapus Postingan (Admin)
                                    </button>
                                </form>
                            </div>
                        @endif
                        
                        <div class="flex gap-4">
                            <a 
                                href="{{ route('dashboard') }}"
                                class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold text-center hover:shadow-lg transition"
                            >
                                🏠 Kembali ke Dashboard
                            </a>
                            <a 
                                href="{{ route('items.create') }}"
                                class="flex-1 border-2 border-blue-600 text-blue-600 py-3 rounded-lg font-semibold text-center hover:bg-blue-50 transition"
                            >
                                ➕ Laporkan Barang Lain
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Info Note --}}
            <div class="mt-6 bg-white/10 backdrop-blur-md text-white p-4 rounded-lg">
                <p class="text-sm">
                    <strong>ℹ️ Info:</strong> Barang ini sekarang bisa dicari oleh pengguna lain. Status barang akan berubah saat ada yang mengklaim.
                </p>
            </div>
        </div>
    </main>
</body>
</html>