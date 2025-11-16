<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PermohonanSurat;
use App\Models\Warga;
use App\Models\JenisSurat;
use Illuminate\Http\Request;

class PermohonanSuratController extends Controller
{
    public function index()
    {
        $permohonan_surat = PermohonanSurat::with(['pemohon', 'jenisSurat'])->latest()->get();
        return view('pages.permohonan-surat.index', compact('permohonan_surat'));
    }

    public function create()
    {
        $warga = Warga::all();
        $jenis_surat = JenisSurat::all();
        return view('pages.permohonan-surat.create', compact('warga', 'jenis_surat'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_permohonan' => 'required|unique:permohonan_surat,nomor_permohonan',
            'pemohon_warga_id' => 'required|exists:warga,warga_id',
            'jenis_id' => 'required|exists:jenis_surat,jenis_id',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required|in:pending,diproses,selesai,ditolak',
            'catatan' => 'nullable|string'
        ]);

        PermohonanSurat::create($validated);

        return redirect()->route('pages.permohonan-surat.index')
            ->with('success', 'Permohonan surat berhasil ditambahkan');
    }

    public function show($id)
    {
        $permohonanSurat = PermohonanSurat::with(['pemohon', 'jenisSurat', 'berkasPersyaratan'])->findOrFail($id);
        return view('pages.permohonan-surat.show', compact('permohonanSurat'));
    }

    public function edit($id)
    {
        $permohonanSurat = PermohonanSurat::findOrFail($id);
        $warga = Warga::all();
        $jenis_surat = JenisSurat::all();
        return view('pages.permohonan-surat.edit', compact('permohonanSurat', 'warga', 'jenis_surat'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nomor_permohonan' => 'required|unique:permohonan_surat,nomor_permohonan,' . $id . ',permohonan_id',
            'pemohon_warga_id' => 'required|exists:warga,warga_id',
            'jenis_id' => 'required|exists:jenis_surat,jenis_id',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required|in:pending,diproses,selesai,ditolak',
            'catatan' => 'nullable|string'
        ]);

        $permohonanSurat = PermohonanSurat::findOrFail($id);
        $permohonanSurat->update($validated);

        return redirect()->route('pages.permohonan-surat.index')
            ->with('success', 'Permohonan surat berhasil diupdate');
    }

    public function destroy($id)
    {
        $permohonanSurat = PermohonanSurat::findOrFail($id);
        $permohonanSurat->delete();

        return redirect()->route('pages.permohonan-surat.index')
            ->with('success', 'Permohonan surat berhasil dihapus');
    }
}
