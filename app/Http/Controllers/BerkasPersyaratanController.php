<?php

namespace App\Http\Controllers;

use App\Models\BerkasPersyaratan;
use App\Models\PermohonanSurat;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BerkasPersyaratanController extends Controller
{
    public function index(Request $request)
    {
        $berkas_persyaratan = BerkasPersyaratan::with(['permohonanSurat.pemohon', 'permohonanSurat.jenisSurat'])
            ->latest()
            ->paginate(10);

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
            'valid' => 'required|boolean',
            'files.*' => 'nullable|mimes:jpg,jpeg,png,gif,webp,mp4,mov,avi,mkv,webm,pdf,doc,docx,zip|max:204800'
        ]);

        $berkas = BerkasPersyaratan::create($validated);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {

                $path = $file->store('uploads/berkas_persyaratan', 'public');

                Media::create([
                    'ref_table' => 'berkas_persyaratan',
                    'ref_id' => $berkas->berkas_id,
                    'file_name' => $path,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => 0
                ]);
            }
        }

        return redirect()->route('admin.berkas-persyaratan.index')->with('success', 'Berkas berhasil ditambahkan');
    }

    public function show($id)
    {
        $berkasPersyaratan = BerkasPersyaratan::with(['permohonanSurat.pemohon', 'permohonanSurat.jenisSurat'])->findOrFail($id);
        $mediaFiles = Media::where('ref_table', 'berkas_persyaratan')->where('ref_id', $id)->get();

        return view('pages.persyaratan.show', compact('berkasPersyaratan', 'mediaFiles'));
    }

    public function edit($id)
    {
        $berkasPersyaratan = BerkasPersyaratan::findOrFail($id);
        $permohonan_surat = PermohonanSurat::with(['pemohon', 'jenisSurat'])->get();

        $mediaFiles = Media::where('ref_table', 'berkas_persyaratan')->where('ref_id', $id)->get();

        return view('pages.persyaratan.edit', compact('berkasPersyaratan', 'permohonan_surat', 'mediaFiles'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'permohonan_id' => 'required|exists:permohonan_surat,permohonan_id',
            'nama_berkas' => 'required|string|max:255',
            'valid' => 'required|boolean',
            'files.*' => 'nullable|mimes:jpg,jpeg,png,gif,webp,mp4,mov,avi,mkv,webm,pdf,doc,docx,zip|max:204800'
        ]);

        $berkas = BerkasPersyaratan::findOrFail($id);
        $berkas->update($validated);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {

                $path = $file->store('uploads/berkas_persyaratan', 'public');

                Media::create([
                    'ref_table' => 'berkas_persyaratan',
                    'ref_id' => $berkas->berkas_id,
                    'file_name' => $path,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => 0
                ]);
            }
        }

        return redirect()->route('admin.berkas-persyaratan.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berkas = BerkasPersyaratan::findOrFail($id);

        $mediaFiles = Media::where('ref_table', 'berkas_persyaratan')->where('ref_id', $id)->get();
        foreach ($mediaFiles as $file) {
            Storage::disk('public')->delete($file->file_name);
            $file->delete();
        }

        $berkas->delete();

        return redirect()->route('admin.berkas-persyaratan.index')->with('success', 'Data berhasil dihapus.');
    }

    public function deleteMedia($id)
    {
        $media = Media::findOrFail($id);
        Storage::disk('public')->delete($media->file_name);
        $media->delete();

        return back()->with('success', 'File berhasil dihapus!');
    }
}
