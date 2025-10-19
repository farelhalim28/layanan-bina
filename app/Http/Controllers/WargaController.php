<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource (READ - INDEX)
     */
    public function index()
    {
        $warga = Warga::latest()->get();
        return view('admin.warga.index', compact('warga'));
    }

    /**
     * Show the form for creating a new resource (CREATE - FORM)
     */
    public function create()
    {
        return view('admin.warga.create');
    }

    /**
     * Store a newly created resource in storage (CREATE - STORE)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_ktp' => 'required|string|max:20|unique:warga,no_ktp',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:100',
            'telp' => 'required|string|max:20',
            'email' => 'required|email|max:100',
        ], [
            'no_ktp.required' => 'No KTP wajib diisi',
            'no_ktp.unique' => 'No KTP sudah terdaftar',
            'nama.required' => 'Nama wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'agama.required' => 'Agama wajib diisi',
            'pekerjaan.required' => 'Pekerjaan wajib diisi',
            'telp.required' => 'Nomor telepon wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
        ]);

        Warga::create($validated);

        return redirect()->route('admin.warga.index')
            ->with('success', 'Data warga berhasil ditambahkan!');
    }

    /**
     * Display the specified resource (READ - SHOW)
     */
    public function show($id)
    {
        $warga = Warga::findOrFail($id);
        return view('admin.warga.show', compact('warga'));
    }

    /**
     * Show the form for editing the specified resource (UPDATE - FORM)
     */
    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('admin.warga.edit', compact('warga'));
    }

    /**
     * Update the specified resource in storage (UPDATE - UPDATE)
     */
    public function update(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);

        $validated = $request->validate([
            'no_ktp' => 'required|string|max:20|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:100',
            'telp' => 'required|string|max:20',
            'email' => 'required|email|max:100',
        ]);

        $warga->update($validated);

        return redirect()->route('admin.warga.index')
            ->with('success', 'Data warga berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage (DELETE)
     */
    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('admin.warga.index')
            ->with('success', 'Data warga berhasil dihapus!');
    }
}
