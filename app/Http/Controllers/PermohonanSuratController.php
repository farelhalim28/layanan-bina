<?php

namespace App\Http\Controllers;

use App\Models\PermohonanSurat;
use App\Models\Warga;
use App\Models\JenisSurat;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PermohonanSuratController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['status'];
        $searchableColumns = ['nomor_permohonan'];

        $permohonan_surat = PermohonanSurat::with(['pemohon', 'jenisSurat'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->latest()
            ->paginate(10)
            ->withQueryString();

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

        return redirect()->route('admin.permohonan-surat.index')
            ->with('success', 'Permohonan surat berhasil ditambahkan');
    }

    public function show($id)
    {
        $permohonanSurat = PermohonanSurat::with(['pemohon', 'jenisSurat', 'berkasPersyaratan'])->findOrFail($id);

        $mediaFiles = Media::where('ref_table', 'permohonan_surat')
            ->where('ref_id', $id)
            ->get();

        return view('pages.permohonan-surat.show', compact('permohonanSurat', 'mediaFiles'));
    }

    public function edit($id)
    {
        $permohonanSurat = PermohonanSurat::findOrFail($id);
        $warga = Warga::all();
        $jenis_surat = JenisSurat::all();

        // Ambil media terkait permohonan
        $mediaFiles = Media::where('ref_table', 'permohonan_surat')
            ->where('ref_id', $id)
            ->get();

        return view('pages.permohonan-surat.edit', compact(
            'permohonanSurat', 'warga', 'jenis_surat', 'mediaFiles'
        ));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nomor_permohonan' => 'required|unique:permohonan_surat,nomor_permohonan,' . $id . ',permohonan_id',
            'pemohon_warga_id' => 'required|exists:warga,warga_id',
            'jenis_id' => 'required|exists:jenis_surat,jenis_id',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required|in:pending,diproses,selesai,ditolak',
            'catatan' => 'nullable|string',
            'files.*' => 'nullable|mimes:jpg,jpeg,png,gif,webp,mp4,mov,avi,mkv,webm,pdf,doc,docx,zip|max:204800'
        ]);

        $permohonanSurat = PermohonanSurat::findOrFail($id);
        $permohonanSurat->update($validated);

        // Upload media baru
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('uploads/permohonan_surat', 'public');

                Media::create([
                    'ref_table' => 'permohonan_surat',
                    'ref_id' => $id,
                    'file_name' => $path,
                    'caption' => $request->input('caption'),
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => 0
                ]);
            }
        }

        return redirect()->route('admin.permohonan-surat.index')
            ->with('success', 'Permohonan surat berhasil diupdate');
    }

    public function destroy($id)
    {
        $permohonanSurat = PermohonanSurat::findOrFail($id);

        $mediaFiles = Media::where('ref_table', 'permohonan_surat')
            ->where('ref_id', $id)
            ->get();

        foreach ($mediaFiles as $media) {
            if (Storage::disk('public')->exists($media->file_name)) {
                Storage::disk('public')->delete($media->file_name);
            }
            $media->delete();
        }

        $permohonanSurat->delete();

        return redirect()->route('admin.permohonan-surat.index')
            ->with('success', 'Permohonan surat berhasil dihapus');
    }

    public function deleteMedia($mediaId)
    {
        $media = Media::findOrFail($mediaId);

        if (Storage::disk('public')->exists($media->file_name)) {
            Storage::disk('public')->delete($media->file_name);
        }

        $media->delete();

        return back()->with('success', 'File berhasil dihapus!');
    }
}
