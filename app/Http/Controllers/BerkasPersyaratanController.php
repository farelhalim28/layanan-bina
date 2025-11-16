<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BerkasPersyaratan;
use App\Models\PermohonanSurat;
use Illuminate\Http\Request;

class BerkasPersyaratanController extends Controller
{
    public function index()
    {
        $berkas_persyaratan = BerkasPersyaratan::with('permohonanSurat')->latest()->get();
        return view('pages.persyaratan.index', compact('berkas_persyaratan'));
    }

    public function create()
    {
        $permohonan_surat = PermohonanSurat::with(['pemohon', 'jenisSurat'])->get();
        return view('pages.persyaratan.create', compact('permohonan_surat'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'permohonan_id' => 'required|exists:permohonan_surat,permohonan_id',
            'nama_berkas' => 'required|string|max:255',
            'valid' => 'required|boolean'
        ]);

        BerkasPersyaratan::create($validated);

        return redirect()->route('pages.persyaratan.index')
            ->with('success', 'Berkas persyaratan berhasil ditambahkan');
    }

    public function show($id)
    {
        $berkasPersyaratan = BerkasPersyaratan::with('permohonanSurat')->findOrFail($id);
        return view('pages.persyaratan.show', compact('berkasPersyaratan'));
    }

    public function edit($id)
    {
        $berkasPersyaratan = BerkasPersyaratan::findOrFail($id);
        $permohonan_surat = PermohonanSurat::with(['pemohon', 'jenisSurat'])->get();
        return view('pages.persyaratan.edit', compact('berkasPersyaratan', 'permohonan_surat'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'permohonan_id' => 'required|exists:permohonan_surat,permohonan_id',
            'nama_berkas' => 'required|string|max:255',
            'valid' => 'required|boolean'
        ]);

        $berkasPersyaratan = BerkasPersyaratan::findOrFail($id);
        $berkasPersyaratan->update($validated);

        return redirect()->route('pages.persyaratan.index')
            ->with('success', 'Berkas persyaratan berhasil diupdate');
    }

    public function destroy($id)
    {
        $berkasPersyaratan = BerkasPersyaratan::findOrFail($id);
        $berkasPersyaratan->delete();

        return redirect()->route('admin.persyaratan.index')
            ->with('success', 'Berkas persyaratan berhasil dihapus');
    }
}
