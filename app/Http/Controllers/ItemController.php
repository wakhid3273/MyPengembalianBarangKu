<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    /**
     * Tampilkan form pelaporan barang temuan
     */
    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    /**
     * Proses penyimpanan barang temuan
     * Sesuai flowchart
     */
    public function store(Request $request)
    {
        // Validasi input sesuai flowchart
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'description' => 'required|string',
            'location_found' => 'required|string|max:255',
            'date_found' => 'required|date',
            'time_found' => 'required',
            'phone' => 'required|string|max:20',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'item_name.required' => 'Nama barang wajib diisi',
            'category_id.required' => 'Kategori wajib dipilih',
            'description.required' => 'Deskripsi wajib diisi',
            'location_found.required' => 'Lokasi penemuan wajib diisi',
            'date_found.required' => 'Tanggal penemuan wajib diisi',
            'time_found.required' => 'Waktu penemuan wajib diisi',
            'phone.required' => 'Nomor telepon wajib diisi',
            'phone.max' => 'Nomor telepon maksimal 20 karakter',
            'photo.required' => 'Foto barang wajib diupload',
            'photo.image' => 'File harus berupa gambar',
            'photo.mimes' => 'Format foto: jpeg, jpg, atau png',
            'photo.max' => 'Ukuran foto maksimal 2MB',
        ]);

        try {
            // Ambil kategori untuk nama folder
            $category = Category::findOrFail($validated['category_id']);
            $categoryFolder = Str::slug($category->category_name);

            // Pastikan folder items/{kategori} ada
            $itemsPath = 'items/' . $categoryFolder;
            if (!Storage::disk('public')->exists($itemsPath)) {
                Storage::disk('public')->makeDirectory($itemsPath);
            }

            // Ambil file foto
            if (!$request->hasFile('photo')) {
                throw new \Exception('Foto tidak ditemukan');
            }
            
            $photo = $request->file('photo');
            $photoExtension = $photo->getClientOriginalExtension();

            // Buat item dulu untuk dapat item_id
            $item = Item::create([
                'category_id' => $validated['category_id'],
                'reporter_id' => Auth::id(),
                'phone' => $validated['phone'],
                'item_name' => $validated['item_name'],
                'description' => $validated['description'],
                'location_found' => $validated['location_found'],
                'date_found' => $validated['date_found'],
                'time_found' => $validated['time_found'],
                'photo_url' => 'temp', // Temporary, akan diupdate setelah upload
                'status' => 'available'
            ]);

            // Upload foto dengan nama final: {item_id}_{item_name}.jpg
            $fileName = $item->item_id . '_' . Str::slug($validated['item_name']) . '.' . $photoExtension;
            $photoPath = $photo->storeAs(
                $itemsPath,
                $fileName,
                'public'
            );

            // Update path di database dengan path final
            $item->update(['photo_url' => $photoPath]);

            return redirect()->route('items.show', $item->item_id)
                ->with('success', '✅ Barang berhasil dilaporkan!');

        } catch (\Exception $e) {
            // Hapus foto jika ada error
            if (isset($photoPath) && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Tampilkan detail barang yang baru dilaporkan
     */
    public function show($id)
    {
        $item = Item::with(['category', 'reporter'])->findOrFail($id);
        return view('items.show', compact('item'));
    }

    /**
 * Halaman pencarian barang
 */
    public function search(Request $request)
    {
        $categories = Category::all();
        
        // Ambil input filter
        $keyword = $request->input('keyword');
        $categoryId = $request->input('category_id');
        $location = $request->input('location');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        
        // Query items dengan filter
        $query = Item::with(['category', 'reporter'])
                    ->where('status', 'available'); // Hanya barang yang tersedia
        
        // Filter keyword (nama atau deskripsi)
        if ($keyword) {
            $query->where(function($q) use ($keyword) {
                $q->where('item_name', 'like', '%' . $keyword . '%')
                ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }
        
        // Filter kategori
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
        
        // Filter lokasi
        if ($location) {
            $query->where('location_found', 'like', '%' . $location . '%');
        }
        
        // Filter rentang tanggal
        if ($dateFrom && $dateTo) {
            $query->whereBetween('date_found', [$dateFrom, $dateTo]);
        } elseif ($dateFrom) {
            $query->where('date_found', '>=', $dateFrom);
        } elseif ($dateTo) {
            $query->where('date_found', '<=', $dateTo);
        }
        
        // Ambil hasil
        $items = $query->orderBy('date_found', 'desc')->get();
        
        return view('items.search', compact('items', 'categories', 'keyword', 'categoryId', 'location', 'dateFrom', 'dateTo'));
    }

    /**
     * Detail barang untuk pencarian (dengan tombol klaim)
     */
    public function detail($id)
    {
        $item = Item::with(['category', 'reporter'])->findOrFail($id);
        return view('items.detail', compact('item'));
    }

    /**
     * Tampilkan form edit barang
     */
    public function edit($id)
    {
        $item = Item::with(['category', 'reporter'])->findOrFail($id);
        
        // Pastikan hanya owner yang bisa edit
        if ($item->reporter_id !== Auth::id()) {
            return redirect()->route('items.show', $item->item_id)
                ->with('error', 'Anda tidak memiliki izin untuk mengedit barang ini.');
        }
        
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    /**
     * Update barang yang sudah dilaporkan
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        
        // Pastikan hanya owner yang bisa update
        if ($item->reporter_id !== Auth::id()) {
            return redirect()->route('items.show', $item->item_id)
                ->with('error', 'Anda tidak memiliki izin untuk mengedit barang ini.');
        }

        // Validasi input
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'description' => 'required|string',
            'location_found' => 'required|string|max:255',
            'date_found' => 'required|date',
            'time_found' => 'required',
            'phone' => 'required|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'item_name.required' => 'Nama barang wajib diisi',
            'category_id.required' => 'Kategori wajib dipilih',
            'description.required' => 'Deskripsi wajib diisi',
            'location_found.required' => 'Lokasi penemuan wajib diisi',
            'date_found.required' => 'Tanggal penemuan wajib diisi',
            'time_found.required' => 'Waktu penemuan wajib diisi',
            'phone.required' => 'Nomor telepon wajib diisi',
            'phone.max' => 'Nomor telepon maksimal 20 karakter',
            'photo.image' => 'File harus berupa gambar',
            'photo.mimes' => 'Format foto: jpeg, jpg, atau png',
            'photo.max' => 'Ukuran foto maksimal 2MB',
        ]);

        try {
            // Ambil kategori untuk nama folder
            $category = Category::findOrFail($validated['category_id']);
            $categoryFolder = Str::slug($category->category_name);
            
            // Simpan foto lama jika akan dihapus
            $oldPhotoPath = $item->photo_url;
            $photoPath = $oldPhotoPath;

            // Jika ada foto baru, upload foto baru
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $fileName = $item->item_id . '_' . Str::slug($validated['item_name']) . '.' . $photo->getClientOriginalExtension();
                
                // Simpan ke: storage/app/public/items/{kategori}/{item_id}_{item_name}.jpg
                $photoPath = $photo->storeAs(
                    'items/' . $categoryFolder,
                    $fileName,
                    'public'
                );

                // Hapus foto lama jika ada dan berbeda
                if ($oldPhotoPath && $oldPhotoPath !== $photoPath && Storage::disk('public')->exists($oldPhotoPath)) {
                    Storage::disk('public')->delete($oldPhotoPath);
                }
            }

            // Update item
            $item->update([
                'category_id' => $validated['category_id'],
                'phone' => $validated['phone'],
                'item_name' => $validated['item_name'],
                'description' => $validated['description'],
                'location_found' => $validated['location_found'],
                'date_found' => $validated['date_found'],
                'time_found' => $validated['time_found'],
                'photo_url' => $photoPath,
            ]);

            return redirect()->route('items.show', $item->item_id)
                ->with('success', '✅ Barang berhasil diperbarui!');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Klaim barang yang sudah dilaporkan
     */
    public function claim($id)
    {
        $item = Item::with(['category', 'reporter'])->findOrFail($id);
        $user = Auth::user();
        
        // Cek apakah barang masih tersedia
        if ($item->status !== 'available') {
            return redirect()->route('items.show', $item->item_id)
                ->with('error', 'Barang ini sudah tidak tersedia untuk diklaim.');
        }
        
        // Cek apakah user mencoba klaim barang miliknya sendiri
        if ($item->reporter_id === $user->user_id) {
            return redirect()->route('items.show', $item->item_id)
                ->with('error', 'Anda tidak dapat mengklaim barang yang Anda laporkan sendiri.');
        }

        try {
            // Update status menjadi claimed
            $item->update([
                'status' => 'claimed'
            ]);

            return redirect()->route('items.show', $item->item_id)
                ->with('success', '✅ Barang berhasil diklaim! Silakan hubungi pelapor untuk mengambil barang.');

        } catch (\Exception $e) {
            return redirect()->route('items.show', $item->item_id)
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Hapus barang yang sudah dilaporkan
     * Owner bisa hapus barang miliknya sendiri
     * Admin bisa hapus semua postingan
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $user = Auth::user();
        
        // Cek apakah user adalah owner atau admin
        $isOwner = $item->reporter_id === $user->user_id;
        $isAdmin = $user->isAdmin();
        
        if (!$isOwner && !$isAdmin) {
            return redirect()->route('items.show', $item->item_id)
                ->with('error', 'Anda tidak memiliki izin untuk menghapus barang ini.');
        }

        try {
            // Hapus foto dari storage
            if ($item->photo_url && Storage::disk('public')->exists($item->photo_url)) {
                Storage::disk('public')->delete($item->photo_url);
            }

            // Hapus item dari database
            $item->delete();

            // Redirect berbeda untuk admin dan owner
            if ($isAdmin) {
                return redirect()->route('dashboard')
                    ->with('success', '✅ Barang berhasil dihapus oleh admin!');
            } else {
                return redirect()->route('profile.show')
                    ->with('success', '✅ Barang berhasil dihapus!');
            }

        } catch (\Exception $e) {
            return redirect()->route('items.show', $item->item_id)
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}