<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'media_id';

    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_name',
        'caption',
        'mime_type',
        'sort_order'
    ];

    /**
     * Scope untuk mendapatkan media berdasarkan referensi
     */
    public function scopeByReference($query, $refTable, $refId)
    {
        return $query->where('ref_table', $refTable)
                     ->where('ref_id', $refId)
                     ->orderBy('sort_order');
    }

    /**
     * Cek apakah file adalah gambar
     */
    public function isImage()
    {
        return str_starts_with($this->mime_type, 'image/');
    }

    /**
     * Cek apakah file adalah video
     */
    public function isVideo()
    {
        return str_starts_with($this->mime_type, 'video/');
    }

    /**
     * Cek apakah file adalah PDF
     */
    public function isPdf()
    {
        return $this->mime_type === 'application/pdf';
    }

    /**
     * Cek apakah file adalah dokumen lain (word, zip, dll)
     */
    public function isFile()
    {
        return !$this->isImage() && !$this->isVideo() && !$this->isPdf();
    }
}
