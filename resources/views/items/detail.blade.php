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
            min-height: 100vh;
        }

        .detail-card {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-klaim {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            transition: all 0.3s ease;
        }

        .btn-klaim:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.4);
        }
    </style>
</head>
<body>
    
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
                    <a href="{{ route('items.search') }}" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-5xl mx-auto">
            
            {{-- Detail Card --}}
            <div class="detail-card bg-white rounded-2xl shadow-2xl overflow-hidden">
                
                {{-- Header Card --}}
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-6">
                    <div class="flex items-center gap-3">
                        <div class="bg-white/20 p-3 rounded-full">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold">Detail Barang yang Ditemukan</h2>
                            <p class="text-sm text-blue-100">ID: #{{ $item->item_id }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        
                        {{-- Left Column: Image --}}
                        <div>
                            <div class="bg-gray-100 rounded-xl overflow-hidden shadow-lg mb-4">
                                <img 
                                    src="{{ $item->getPhotoDisplayUrl() }}" 
                                    alt="{{ $item->item_name }}"
                                    class="w-full h-auto object-cover"
                                    onerror="this.src='https://via.placeholder.com/500x400?text=Foto+Tidak+Tersedia'"
                                >
                            </div>
                            
                            {{-- Info Pelapor --}}
                            <div class="bg-gray-50 rounded-xl p-4">
                                <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Dilaporkan Oleh</label>
                                <div class="flex items-center gap-3 mt-2">
                                    <div class="bg-gradient-to-br from-blue-500 to-purple-600 w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                        {{ substr($item->reporter->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $item->reporter->name }}</p>
                                        <p class="text-sm text-gray-500 capitalize">{{ $item->reporter->role }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Right Column: Details --}}
                        <div class="space-y-6">
                            
                            {{-- Status Badge --}}
                            <div class="flex items-center gap-2">
                                @if($item->status === 'available')
                                    <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        Tersedia
                                    </span>
                                @elseif($item->status === 'claimed')
                                    <span class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-full text-sm font-semibold flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                        Diklaim
                                    </span>
                                @else
                                    <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold flex items-center gap-2">
                                        Dikembalikan
                                    </span>
                                @endif
                                <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">
                                    {{ $item->category->category_name }}
                                </span>
                            </div>

                            {{-- Nama Barang --}}
                            <div>
                                <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Nama Barang</label>
                                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $item->item_name }}</p>
                            </div>

                            {{-- Deskripsi --}}
                            <div>
                                <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Deskripsi</label>
                                <p class="text-gray-700 mt-1 leading-relaxed">{{ $item->description }}</p>
                            </div>

                            {{-- Info Grid --}}
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="text-xs font-semibold text-gray-500 uppercase flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Lokasi
                                    </label>
                                    <p class="text-gray-800 font-semibold mt-1">{{ $item->location_found }}</p>
                                </div>
                                
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="text-xs font-semibold text-gray-500 uppercase flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        Kategori
                                    </label>
                                    <p class="text-gray-800 font-semibold mt-1">{{ $item->category->category_name }}</p>
                                </div>
                                
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="text-xs font-semibold text-gray-500 uppercase flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Tanggal
                                    </label>
                                    <p class="text-gray-800 font-semibold mt-1">{{ date('d/m/Y', strtotime($item->date_found)) }}</p>
                                </div>
                                
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="text-xs font-semibold text-gray-500 uppercase flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Waktu
                                    </label>
                                    <p class="text-gray-800 font-semibold mt-1">{{ date('H:i', strtotime($item->time_found)) }}</p>
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

                            {{-- Alert Info --}}
                            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                                <div class="flex items-start gap-3">
                                    <svg class="w-6 h-6 text-blue-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    <div class="text-sm text-blue-700">
                                        <p class="font-semibold mb-1">Ini barang kamu?</p>
                                        <p>Klik tombol "Klaim Barang" di bawah untuk mengajukan klaim. Kamu akan diminta upload bukti kepemilikan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="mt-8 pt-6 border-t flex gap-4">
                        @if($item->status === 'available' && $item->reporter_id !== Auth::id())
                            <form 
                                action="{{ route('items.claim', $item->item_id) }}" 
                                method="POST" 
                                class="flex-1"
                                onsubmit="return confirm('Apakah Anda yakin ingin mengklaim barang ini?');"
                            >
                                @csrf
                                <button 
                                    type="submit"
                                    class="btn-klaim w-full text-white py-4 rounded-lg font-semibold text-lg flex items-center justify-center gap-2"
                                >
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Klaim Barang Ini
                                </button>
                            </form>
                        @elseif($item->status === 'claimed')
                            <div class="flex-1 bg-yellow-100 text-yellow-700 py-4 rounded-lg font-semibold text-lg flex items-center justify-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                Barang Sudah Diklaim
                            </div>
                        @elseif($item->reporter_id === Auth::id())
                            <div class="flex-1 bg-gray-100 text-gray-600 py-4 rounded-lg font-semibold text-lg flex items-center justify-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Ini Barang Anda
                            </div>
                        @endif
                        <a 
                            href="{{ route('items.search') }}"
                            class="px-8 py-4 border-2 border-gray-300 rounded-lg hover:bg-gray-50 transition text-center font-semibold"
                        >
                            Kembali ke Pencarian
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>