<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;

    protected $table = 'jenis_surat';
    protected $primaryKey = 'jenis_id';

    protected $fillable = [
        'kode',
        'nama_jenis',
        'syarat_json'
    ];
}
