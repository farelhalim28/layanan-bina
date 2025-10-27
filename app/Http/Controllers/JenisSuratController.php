<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    public function index()
    {
        $jenis_surat = JenisSurat::latest()->get();
        return view('pages.jenis_surat.index', compact('jenis_surat'));
    }

    public function create()
    {
        return view('pages.jenis_surat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:20|unique:jenis_surat,kode',
            'nama_jenis' => 'required|string|max:100',
            'syarat_json' => 'nullable|string',
        ]);

        JenisSurat::create($validated);

        return redirect()->route('admin.jenis-surat.index')
            ->with('success', 'Jenis surat berhasil ditambahkan!');
    }

    public function show($id)
    {
        $jenisSurat = JenisSurat::findOrFail($id);
        return view('pages.jenis_surat.show', compact('jenisSurat'));
    }

    public function edit($id)
    {
        $jenisSurat = JenisSurat::findOrFail($id);
        return view('pages.jenis_surat.edit', compact('jenisSurat'));
    }

    public function update(Request $request, $id)
    {
        $jenisSurat = JenisSurat::findOrFail($id);

        $validated = $request->validate([
            'kode' => 'required|string|max:20|unique:jenis_surat,kode,' . $id . ',jenis_id',
            'nama_jenis' => 'required|string|max:100',
            'syarat_json' => 'nullable|string',
        ]);

        $jenisSurat->update($validated);

        return redirect()->route('admin.jenis-surat.index')
            ->with('success', 'Jenis surat berhasil diupdate!');
    }

    public function destroy($id)
    {
        $jenisSurat = JenisSurat::findOrFail($id);
        $jenisSurat->delete();

        return redirect()->route('admin.jenis-surat.index')
            ->with('success', 'Jenis surat berhasil dihapus!');
    }
}
