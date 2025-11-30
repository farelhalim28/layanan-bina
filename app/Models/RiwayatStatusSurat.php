<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class RiwayatStatusSurat extends Model
{
    use HasFactory;

    protected $table = 'riwayat_status_surat';
    protected $primaryKey = 'riwayat_id';

    protected $fillable = [
        'permohonan_id',
        'status',
        'petugas_warga_id',
        'waktu',
        'keterangan'
    ];

    protected $casts = [
        'waktu' => 'datetime',
    ];

    // Relasi ke Permohonan Surat
    public function permohonanSurat()
    {
        return $this->belongsTo(PermohonanSurat::class, 'permohonan_id', 'permohonan_id');
    }

    // Relasi ke Warga sebagai Petugas
    public function petugas()
    {
        return $this->belongsTo(Warga::class, 'petugas_warga_id', 'warga_id');
    }

    /**
     * Scope Filter
     */
    public function scopeFilter(Builder $query, $request, array $columns)
    {
        foreach ($columns as $column) {
            if ($request->filled($column)) {

                if ($column === 'status') {
                    $query->where('status', $request->status);
                }

                if ($column === 'petugas_warga_id') {
                    $query->where('petugas_warga_id', $request->petugas_warga_id);
                }
            }
        }
        return $query;
    }

    /**
     * Scope Search
     */
    public function scopeSearch(Builder $query, $request)
    {
        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('permohonanSurat', function($q) use ($search) {
                $q->where('nomor_permohonan', 'LIKE', "%$search%");
            })
            ->orWhereHas('petugas', function($q) use ($search) {
                $q->where('nama', 'LIKE', "%$search%");
            });
        }

        return $query;
    }
}
