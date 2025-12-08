<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang - MyPengembalianBarangKu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-stone-50 font-sans text-stone-800 min-h-screen">

    {{-- Header --}}
    <header class="bg-primary-900 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-white/10 rounded-lg">
                        <svg class="w-6 h-6 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-sans font-bold tracking-wide">MyPengembalian<span
                                class="text-gold-500">BarangKu</span></h1>
                        <p class="text-xs text-primary-100 tracking-wider uppercase">Edit Barang</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="font-medium text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-primary-200 capitalize">{{ Auth::user()->role }}</p>
                    </div>
                    <a href="{{ route('items.show', $item->item_id) }}"
                        class="bg-primary-800 hover:bg-primary-700 border border-primary-700 px-4 py-2 rounded-lg transition text-sm font-medium shadow-sm hover:shadow">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">

            {{-- Form Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-stone-100 p-8">

                {{-- Title --}}
                <div class="text-center mb-8 border-b border-stone-100 pb-6">
                    <div class="bg-primary-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-sans font-bold text-stone-800 mb-2">
                        Edit Barang
                    </h2>
                    <p class="text-stone-500">Perbarui informasi barang yang dilaporkan</p>
                </div>

                {{-- Alert Error --}}
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-r-lg mb-6">
                        <p class="font-semibold mb-2">⚠️ Terjadi kesalahan:</p>
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-r-lg mb-6">
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                @endif

                {{-- Form --}}
                <form action="{{ route('items.update', $item->item_id) }}" method="POST" enctype="multipart/form-data"
                    id="editForm" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Nama Barang --}}
                    <div>
                        <label for="item_name" class="block text-sm font-semibold text-stone-700 mb-2">
                            Nama Barang <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="item_name" id="item_name"
                            value="{{ old('item_name', $item->item_name) }}" placeholder="Contoh: Dompet Hitam"
                            class="w-full px-4 py-3 border border-stone-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all bg-stone-50 focus:bg-white"
                            required>
                    </div>

                    {{-- Kategori Barang --}}
                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-stone-700 mb-2">
                            Kategori Barang <span class="text-red-500">*</span>
                        </label>
                        <select name="category_id" id="category_id"
                            class="w-full px-4 py-3 border border-stone-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all bg-stone-50 focus:bg-white"
                            required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->category_id }}" {{ old('category_id', $item->category_id) == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-stone-400 mt-2">
                            📁 Foto akan disimpan di: <span
                                class="font-mono bg-stone-100 px-2 py-1 rounded">storage/items/<span
                                    id="category-folder">{{ strtolower(str_replace(' ', '-', $item->category->category_name)) }}</span>/</span>
                        </p>
                    </div>

                    {{-- Deskripsi Barang --}}
                    <div>
                        <label for="description" class="block text-sm font-semibold text-stone-700 mb-2">
                            Deskripsi Barang <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" id="description" rows="4"
                            placeholder="Jelaskan ciri-ciri barang secara detail (warna, ukuran, merek, dll)"
                            class="w-full px-4 py-3 border border-stone-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all bg-stone-50 focus:bg-white resize-none"
                            required>{{ old('description', $item->description) }}</textarea>
                        <p class="text-xs text-stone-400 mt-1 flex justify-end">
                            <span id="char-count">{{ strlen(old('description', $item->description)) }}</span>/500
                            karakter
                        </p>
                    </div>

                    {{-- Lokasi Penemuan --}}
                    <div>
                        <label for="location_found" class="block text-sm font-semibold text-stone-700 mb-2">
                            Lokasi Penemuan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="location_found" id="location_found"
                            value="{{ old('location_found', $item->location_found) }}"
                            placeholder="Contoh: Gedung C Lantai 2"
                            class="w-full px-4 py-3 border border-stone-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all bg-stone-50 focus:bg-white"
                            required>
                    </div>

                    {{-- Nomor Telepon --}}
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-stone-700 mb-2">
                            Nomor Telepon <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone', $item->phone) }}"
                            placeholder="Contoh: 081234567890"
                            class="w-full px-4 py-3 border border-stone-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all bg-stone-50 focus:bg-white"
                            required>
                        <p class="text-xs text-stone-400 mt-1">
                            Nomor telepon akan digunakan untuk menghubungi Anda terkait barang yang dilaporkan
                        </p>
                    </div>

                    {{-- Tanggal dan Waktu Penemuan --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="date_found" class="block text-sm font-semibold text-stone-700 mb-2">
                                Tanggal Penemuan <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="date_found" id="date_found"
                                value="{{ old('date_found', $item->date_found->format('Y-m-d')) }}"
                                max="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-3 border border-stone-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all bg-stone-50 focus:bg-white"
                                required>
                        </div>
                        <div>
                            <label for="time_found" class="block text-sm font-semibold text-stone-700 mb-2">
                                Waktu Penemuan <span class="text-red-500">*</span>
                            </label>
                            <input type="time" name="time_found" id="time_found"
                                value="{{ old('time_found', $item->time_found) }}"
                                class="w-full px-4 py-3 border border-stone-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all bg-stone-50 focus:bg-white"
                                required>
                        </div>
                    </div>

                    {{-- Upload Foto Barang --}}
                    <div>
                        <label for="photo" class="block text-sm font-semibold text-stone-700 mb-2">
                            Foto Barang <span class="text-stone-400 text-xs font-normal">(Opsional - Kosongkan jika
                                tidak ingin mengubah)</span>
                        </label>
                        <div
                            class="border-2 border-dashed border-stone-300 rounded-xl p-8 text-center hover:border-primary-500 hover:bg-primary-50/50 transition duration-300">
                            <input type="file" name="photo" id="photo" accept="image/jpeg,image/jpg,image/png"
                                class="hidden" onchange="previewImage(this)">
                            <div id="upload-prompt">
                                <label for="photo" class="cursor-pointer">
                                    <div
                                        class="bg-stone-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-stone-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-stone-700 font-medium mb-1">Klik untuk upload foto baru</p>
                                    <p class="text-xs text-stone-400">Format: JPG, JPEG, PNG (Max 2MB)</p>
                                </label>
                            </div>
                            <div id="preview-container" class="hidden">
                                <img id="preview-image" src="" alt="Preview"
                                    class="max-h-80 mx-auto rounded-lg mb-4 shadow-lg">
                                <button type="button" onclick="removeImage()"
                                    class="text-red-600 hover:text-red-700 text-sm font-medium flex items-center justify-center mx-auto">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Hapus Foto Baru
                                </button>
                            </div>
                        </div>
                        {{-- Tampilkan foto lama --}}
                        @if($item->photo_url)
                            <div class="mt-4 p-4 bg-stone-50 rounded-xl border border-stone-200">
                                <p class="text-xs text-stone-500 mb-2 font-bold uppercase">Foto saat ini:</p>
                                <img src="{{ $item->getPhotoDisplayUrl() }}" alt="Foto saat ini"
                                    class="max-h-40 rounded-lg border border-stone-300">
                            </div>
                        @endif
                    </div>

                    {{-- Buttons --}}
                    <div class="flex gap-4 pt-4">
                        <button type="submit"
                            class="flex-1 bg-primary-700 hover:bg-primary-800 text-white py-3.5 rounded-xl font-bold text-lg shadow-sm hover:shadow transition transform hover:-translate-y-0.5">
                            💾 Perbarui Barang
                        </button>
                        <a href="{{ route('items.show', $item->item_id) }}"
                            class="px-8 py-3.5 border border-stone-300 rounded-xl hover:bg-stone-50 transition text-center font-medium text-stone-600">
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
                reader.onload = function (e) {
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
        document.getElementById('category_id').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const categoryName = selectedOption.text.toLowerCase().replace(/ /g, '-');
            document.getElementById('category-folder').textContent = categoryName || 'kategori';
        });

        // Character counter
        const descriptionField = document.getElementById('description');
        const charCount = document.getElementById('char-count');

        descriptionField.addEventListener('input', function () {
            const length = this.value.length;
            charCount.textContent = length;

            if (length > 500) {
                charCount.classList.add('text-red-500');
            } else {
                charCount.classList.remove('text-red-500');
            }
        });

        // Form confirmation
        document.getElementById('editForm').addEventListener('submit', function (e) {
            const confirmation = confirm('Apakah data yang Anda masukkan sudah benar?');
            if (!confirmation) {
                e.preventDefault();
            }
        });
    </script>
</body>

</html>
