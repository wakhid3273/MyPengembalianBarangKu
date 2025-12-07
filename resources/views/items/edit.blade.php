<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang - MyPengembalianBarangKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    /* Animated Background - Fixed height */
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: relative;
        min-height: 100vh;
        overflow-y: auto;
        overflow-x: hidden;
    }

    body::before {
        content: '';
        position: fixed;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1%, transparent 1%);
        background-size: 50px 50px;
        animation: moveGrid 20s linear infinite;
        z-index: 0;
        pointer-events: none;
    }

    @keyframes moveGrid {
        0% { transform: translate(0, 0); }
        100% { transform: translate(50px, 50px); }
    }

    /* Main container - Limit scroll */
    main {
        padding-bottom: 2rem !important; /* Batas bawah */
    }

    /* Form Animation */
    .form-container {
        animation: slideInUp 0.6s ease-out;
        margin-bottom: 2rem; /* Jarak bawah form */
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Input Focus Effect */
    .input-field:focus {
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
        border-color: #667eea;
        outline: none;
    }

    /* Upload Zone Hover */
    .upload-zone {
        transition: all 0.3s ease;
    }

    .upload-zone:hover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
    }

    /* Button Hover */
    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
    }
    </style>
</head>
<body class="animated-bg">
    
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
                        <p class="text-sm text-white/80">Edit Barang</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-white/80 capitalize">{{ Auth::user()->role }}</p>
                    </div>
                    <a href="{{ route('items.show', $item->item_id) }}" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="container mx-auto px-4 py-8 relative z-10" style="padding-bottom: 2rem;">
        <div class="max-w-3xl mx-auto">
            
            {{-- Form Card --}}
            <div class="form-container bg-white rounded-2xl shadow-2xl p-8">
                
                {{-- Title --}}
                <div class="text-center mb-8">
                    <div class="bg-gradient-to-br from-blue-500 to-purple-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                        Edit Barang
                    </h2>
                    <p class="text-gray-600">Perbarui informasi barang yang dilaporkan</p>
                </div>

                {{-- Alert Error --}}
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg mb-6">
                        <p class="font-semibold mb-2">⚠️ Terjadi kesalahan:</p>
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg mb-6">
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                @endif

                {{-- Form --}}
                <form action="{{ route('items.update', $item->item_id) }}" method="POST" enctype="multipart/form-data" id="editForm">
                    @csrf
                    @method('PUT')

                    {{-- Nama Barang --}}
                    <div class="mb-6">
                        <label for="item_name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Barang <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="item_name" 
                            id="item_name"
                            value="{{ old('item_name', $item->item_name) }}"
                            placeholder="Contoh: Dompet Hitam"
                            class="input-field w-full px-4 py-3 border-2 border-gray-200 rounded-lg transition-all"
                            required
                        >
                    </div>

                    {{-- Kategori Barang --}}
                    <div class="mb-6">
                        <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori Barang <span class="text-red-500">*</span>
                        </label>
                        <select 
                            name="category_id" 
                            id="category_id"
                            class="input-field w-full px-4 py-3 border-2 border-gray-200 rounded-lg transition-all"
                            required
                        >
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->category_id }}" {{ old('category_id', $item->category_id) == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-2">
                            📁 Foto akan disimpan di: <span class="font-mono bg-gray-100 px-2 py-1 rounded">storage/items/<span id="category-folder">{{ strtolower(str_replace(' ', '-', $item->category->category_name)) }}</span>/</span>
                        </p>
                    </div>

                    {{-- Deskripsi Barang --}}
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi Barang <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            name="description" 
                            id="description"
                            rows="4"
                            placeholder="Jelaskan ciri-ciri barang secara detail (warna, ukuran, merek, dll)"
                            class="input-field w-full px-4 py-3 border-2 border-gray-200 rounded-lg transition-all resize-none"
                            required
                        >{{ old('description', $item->description) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">
                            <span id="char-count">{{ strlen(old('description', $item->description)) }}</span>/500 karakter
                        </p>
                    </div>

                    {{-- Lokasi Penemuan --}}
                    <div class="mb-6">
                        <label for="location_found" class="block text-sm font-semibold text-gray-700 mb-2">
                            Lokasi Penemuan <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="location_found" 
                            id="location_found"
                            value="{{ old('location_found', $item->location_found) }}"
                            placeholder="Contoh: Gedung C Lantai 2"
                            class="input-field w-full px-4 py-3 border-2 border-gray-200 rounded-lg transition-all"
                            required
                        >
                    </div>

                    {{-- Nomor Telepon --}}
                    <div class="mb-6">
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nomor Telepon <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="tel" 
                            name="phone" 
                            id="phone"
                            value="{{ old('phone', $item->phone) }}"
                            placeholder="Contoh: 081234567890"
                            class="input-field w-full px-4 py-3 border-2 border-gray-200 rounded-lg transition-all"
                            required
                        >
                        <p class="text-xs text-gray-500 mt-1">
                            Nomor telepon akan digunakan untuk menghubungi Anda terkait barang yang dilaporkan
                        </p>
                    </div>

                    {{-- Tanggal dan Waktu Penemuan --}}
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="date_found" class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Penemuan <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="date" 
                                name="date_found" 
                                id="date_found"
                                value="{{ old('date_found', $item->date_found->format('Y-m-d')) }}"
                                max="{{ date('Y-m-d') }}"
                                class="input-field w-full px-4 py-3 border-2 border-gray-200 rounded-lg transition-all"
                                required
                            >
                        </div>
                        <div>
                            <label for="time_found" class="block text-sm font-semibold text-gray-700 mb-2">
                                Waktu Penemuan <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="time" 
                                name="time_found" 
                                id="time_found"
                                value="{{ old('time_found', $item->time_found) }}"
                                class="input-field w-full px-4 py-3 border-2 border-gray-200 rounded-lg transition-all"
                                required
                            >
                        </div>
                    </div>

                    {{-- Upload Foto Barang --}}
                    <div class="mb-8">
                        <label for="photo" class="block text-sm font-semibold text-gray-700 mb-2">
                            Foto Barang <span class="text-gray-400 text-xs">(Opsional - Kosongkan jika tidak ingin mengubah)</span>
                        </label>
                        <div class="upload-zone border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                            <input 
                                type="file" 
                                name="photo" 
                                id="photo"
                                accept="image/jpeg,image/jpg,image/png"
                                class="hidden"
                                onchange="previewImage(this)"
                            >
                            <div id="upload-prompt">
                                <label for="photo" class="cursor-pointer">
                                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <p class="text-gray-700 font-medium mb-2">Klik untuk upload foto baru</p>
                                    <p class="text-xs text-gray-500">Format: JPG, JPEG, PNG (Max 2MB)</p>
                                </label>
                            </div>
                            <div id="preview-container" class="hidden">
                                <img id="preview-image" src="" alt="Preview" class="max-h-80 mx-auto rounded-lg mb-4 shadow-lg">
                                <button type="button" onclick="removeImage()" class="text-red-600 hover:text-red-700 text-sm font-medium">
                                    ✕ Hapus Foto
                                </button>
                            </div>
                        </div>
                        {{-- Tampilkan foto lama --}}
                        @if($item->photo_url)
                            <div class="mt-4">
                                <p class="text-xs text-gray-500 mb-2">Foto saat ini:</p>
                                <img 
                                    src="{{ $item->getPhotoDisplayUrl() }}" 
                                    alt="Foto saat ini"
                                    class="max-h-40 rounded-lg border-2 border-gray-200"
                                >
                            </div>
                        @endif
                    </div>

                    {{-- Buttons --}}
                    <div class="flex gap-4">
                        <button 
                            type="submit"
                            class="btn-submit flex-1 text-white py-4 rounded-lg font-semibold text-lg"
                        >
                            💾 Perbarui Barang
                        </button>
                        <a 
                            href="{{ route('items.show', $item->item_id) }}"
                            class="px-8 py-4 border-2 border-gray-300 rounded-lg hover:bg-gray-50 transition text-center font-semibold"
                        >
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Preview image
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                    document.getElementById('preview-container').classList.remove('hidden');
                    document.getElementById('upload-prompt').classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Remove image
        function removeImage() {
            document.getElementById('photo').value = '';
            document.getElementById('preview-container').classList.add('hidden');
            document.getElementById('upload-prompt').classList.remove('hidden');
        }

        // Update folder path based on category
        document.getElementById('category_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const categoryName = selectedOption.text.toLowerCase().replace(/ /g, '-');
            document.getElementById('category-folder').textContent = categoryName || 'kategori';
        });

        // Character counter
        const descriptionField = document.getElementById('description');
        const charCount = document.getElementById('char-count');
        
        descriptionField.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = length;
            
            if (length > 500) {
                charCount.classList.add('text-red-500');
            } else {
                charCount.classList.remove('text-red-500');
            }
        });

        // Form confirmation
        document.getElementById('editForm').addEventListener('submit', function(e) {
            const confirmation = confirm('Apakah data yang Anda masukkan sudah benar?');
            if (!confirmation) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>

