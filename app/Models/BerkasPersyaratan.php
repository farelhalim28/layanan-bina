<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BerkasPersyaratan extends Model
{
    use HasFactory;

    protected $table = 'berkas_persyaratan';
    protected $primaryKey = 'berkas_id';

    protected $fillable = [
        'permohonan_id',
        'nama_berkas',
        'valid'
    ];

    protected $casts = [
        'valid' => 'boolean',
    ];

    // Relasi ke Permohonan Surat
    public function permohonanSurat()
    {
        return $this->belongsTo(PermohonanSurat::class, 'permohonan_id', 'permohonan_id');
    }

    /**
     * Scope untuk Filter
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                // Handle boolean untuk kolom 'valid'
                if ($column === 'valid') {
                    $query->where($column, $request->input($column) == '1');
                } else {
                    $query->where($column, $request->input($column));
                }
            }
        }
        return $query;
    }

    /**
     * Scope untuk Search
     */
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
        return $query;
    }
}
