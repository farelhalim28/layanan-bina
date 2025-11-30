<?php

namespace App\Http\Controllers;

use App\Models\RiwayatStatusSurat;
use App\Models\PermohonanSurat;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RiwayatStatusSuratController extends Controller
{
    public function index(Request $request)
    {
        $filterable = ['status', 'petugas_warga_id'];

        $riwayat_status = RiwayatStatusSurat::with(['permohonanSurat', 'petugas'])
            ->filter($request, $filterable)
            ->search($request, ['keterangan'])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $petugas_list = Warga::all();

        return view('pages.riwayat-status.index', compact('riwayat_status', 'petugas_list'));
    }

    public function create()
    {
        $permohonan_surat = PermohonanSurat::with(['pemohon', 'jenisSurat'])->get();
        $warga = Warga::all();

        return view('pages.riwayat-status.create', compact('permohonan_surat', 'warga'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'permohonan_id' => 'required|exists:permohonan_surat,permohonan_id',
            'status' => 'required|in:pending,diproses,selesai,ditolak',
            'petugas_warga_id' => 'required|exists:warga,warga_id',
            'waktu' => 'required|date',
            'keterangan' => 'nullable|string',
            'files.*' => 'nullable|file|max:102400'
        ]);

        $riwayat = RiwayatStatusSurat::create($validated);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('uploads/riwayat_status', 'public');

                Media::create([
                    'ref_table' => 'riwayat_status',
                    'ref_id' => $riwayat->riwayat_id,
                    'file_name' => $path,
                ]);
            }
        }

        return redirect()->route('admin.riwayat-status.index')->with('success', 'Riwayat status berhasil ditambahkan');
    }

    public function show($id)
    {
        $riwayatStatus = RiwayatStatusSurat::with(['permohonanSurat', 'petugas'])->findOrFail($id);
        $files = Media::where('ref_table', 'riwayat_status')->where('ref_id', $id)->get();

        return view('pages.riwayat-status.show', compact('riwayatStatus', 'files'));
    }

    public function edit($id)
    {
        $riwayatStatus = RiwayatStatusSurat::findOrFail($id);
        $permohonan_surat = PermohonanSurat::all();
        $warga = Warga::all();
        $files = Media::where('ref_table', 'riwayat_status')->where('ref_id', $id)->get();

        return view('pages.riwayat-status.edit', compact('riwayatStatus', 'permohonan_surat', 'warga', 'files'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'permohonan_id' => 'required|exists:permohonan_surat,permohonan_id',
            'status' => 'required|in:pending,diproses,selesai,ditolak',
            'petugas_warga_id' => 'required|exists:warga,warga_id',
            'waktu' => 'required|date',
            'keterangan' => 'nullable|string',
            'files.*' => 'nullable|file|max:102400'
        ]);

        $riwayat = RiwayatStatusSurat::findOrFail($id);
        $riwayat->update($validated);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {

                $path = $file->store('uploads/riwayat_status', 'public');

                Media::create([
                    'ref_table' => 'riwayat_status',
                    'ref_id' => $riwayat->riwayat_id,
                    'file_name' => $path,
                ]);
            }
        }

        return redirect()->route('admin.riwayat-status.index')->with('success', 'Riwayat status diperbarui');
    }

    public function destroy($id)
    {
        $riwayat = RiwayatStatusSurat::findOrFail($id);
        $files = Media::where('ref_table', 'riwayat_status')->where('ref_id', $id)->get();

        foreach ($files as $file) {
            Storage::disk('public')->delete($file->file_name);
            $file->delete();
        }

        $riwayat->delete();

        return redirect()->route('admin.riwayat-status.index')->with('success', 'Riwayat status dihapus');
    }

    public function deleteMedia($id)
    {
        $media = Media::findOrFail($id);
        Storage::disk('public')->delete($media->file_name);
        $media->delete();

        return back()->with('success', 'Lampiran berhasil dihapus');
    }
}
