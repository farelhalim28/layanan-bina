<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanSurat extends Model
{
    use HasFactory;

    protected $table = 'permohonan_surat';
    protected $primaryKey = 'permohonan_id';

    protected $fillable = [
        'nomor_permohonan',
        'pemohon_warga_id',
        'jenis_id',
        'tanggal_pengajuan',
        'status',
        'catatan'
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'date',
    ];

    // Relasi ke Warga (pemohon)
    public function pemohon()
    {
        return $this->belongsTo(Warga::class, 'pemohon_warga_id', 'warga_id');
    }

    // Relasi ke Jenis Surat
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_id', 'jenis_id');
    }

    // Relasi ke Berkas Persyaratan
    public function berkasPersyaratan()
    {
        return $this->hasMany(BerkasPersyaratan::class, 'permohonan_id', 'permohonan_id');
    }
}
