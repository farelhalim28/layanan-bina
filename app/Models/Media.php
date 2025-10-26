<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'media';

    /**
     * Primary key
     */
    protected $primaryKey = 'media_id';

    /**
     * Kolom yang bisa diisi (mass assignment)
     */
    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_url',
        'caption',
        'mime_type',
        'sort_order',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'ref_id' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Accessor untuk mendapatkan full URL file
     */
    public function getFullUrlAttribute()
    {
        return asset('storage/' . $this->file_url);
    }

    /**
     * Accessor untuk cek apakah file adalah gambar
     */
    public function getIsImageAttribute()
    {
        return str_starts_with($this->mime_type, 'image/');
    }

    /**
     * Accessor untuk mendapatkan icon berdasarkan mime type
     */
    public function getFileIconAttribute()
    {
        if ($this->is_image) {
            return 'bi-image';
        } elseif (str_contains($this->mime_type, 'pdf')) {
            return 'bi-file-pdf';
        } elseif (str_contains($this->mime_type, 'word')) {
            return 'bi-file-word';
        } elseif (str_contains($this->mime_type, 'excel') || str_contains($this->mime_type, 'spreadsheet')) {
            return 'bi-file-excel';
        } else {
            return 'bi-file-earmark';
        }
    }
}
