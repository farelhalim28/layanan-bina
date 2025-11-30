<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipleUpload extends Model
{
    use HasFactory;

    protected $table = 'multipleuploads';

    protected $fillable = [
        'filename',
        'original_name',
        'file_path',
        'ref_table',
        'ref_id'
    ];

    /**
     * Scope untuk mendapatkan file berdasarkan referensi
     */
    public function scopeByReference($query, $refTable, $refId)
    {
        return $query->where('ref_table', $refTable)
                     ->where('ref_id', $refId);
    }
}
