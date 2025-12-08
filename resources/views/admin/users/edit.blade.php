<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna - Admin MyPengembalianBarangKu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
        <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-stone-100 p-8">
            <h2 class="text-2xl font-sans font-bold text-stone-800 mb-6">Edit Data Pengguna</h2>

            <form action="{{ route('admin.users.update', $user->user_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-stone-700 font-medium mb-1">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full rounded-lg border-stone-300 focus:border-primary-500 focus:ring focus:ring-primary-200 transition">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-stone-700 font-medium mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full rounded-lg border-stone-300 focus:border-primary-500 focus:ring focus:ring-primary-200 transition">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-stone-700 font-medium mb-1">Role</label>
                    <select name="role"
                        class="w-full rounded-lg border-stone-300 focus:border-primary-500 focus:ring focus:ring-primary-200 transition">
                        <option value="mahasiswa" {{ $user->role == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        <option value="satpam" {{ $user->role == 'satpam' ? 'selected' : '' }}>Satpam</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="bg-primary-700 hover:bg-primary-800 text-white px-6 py-2 rounded-lg font-medium transition">Simpan
                        Perubahan</button>
                    <a href="{{ route('admin.users.index') }}"
                        class="bg-stone-100 hover:bg-stone-200 text-stone-700 px-6 py-2 rounded-lg font-medium transition">Batal</a>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
