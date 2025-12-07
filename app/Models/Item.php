<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'item_id';

    protected $fillable = [
        'category_id',
        'reporter_id',
        'phone',
        'item_name',
        'description',
        'location_found',
        'date_found',
        'time_found',
        'photo_url',
        'status'
    ];

    protected $casts = [
        'date_found' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id', 'user_id');
    }

    /**
     * Get full photo URL for display with fallback
     */
    public function getPhotoDisplayUrl()
    {
        $photoUrl = $this->attributes['photo_url'] ?? null;
        
        // Jika photo_url adalah 'temp', kosong, atau null
        if (empty($photoUrl) || $photoUrl === 'temp') {
            return 'https://via.placeholder.com/400x300?text=Foto+Tidak+Tersedia';
        }

        // Cek apakah file benar-benar ada di storage
        if (!\Illuminate\Support\Facades\Storage::disk('public')->exists($photoUrl)) {
            return 'https://via.placeholder.com/400x300?text=Foto+Tidak+Ditemukan';
        }

        return asset('storage/' . $photoUrl);
    }
}