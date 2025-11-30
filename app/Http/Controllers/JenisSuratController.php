<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JenisSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Kolom yang bisa di-filter
        $filterableColumns = ['kode'];

        // Kolom yang bisa di-search
        $searchableColumns = ['kode', 'nama_jenis'];

        // Query dengan filter, search, dan pagination
        $query = JenisSurat::query();

        // Filter berdasarkan kode (jika ada)
        if ($request->filled('filter_kode')) {
            $query->where('kode', $request->filter_kode);
        }

        // Search
        $jenis_surat = $query->search($request, $searchableColumns)
                             ->latest()
                             ->paginate(10)
                             ->withQueryString();

        return view('pages.jenis_surat.index', compact('jenis_surat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.jenis_surat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jenisSurat = JenisSurat::findOrFail($id);

        // Ambil semua media yang terkait dengan jenis surat ini
        $mediaFiles = Media::where('ref_table', 'jenis_surat')
                           ->where('ref_id', $jenisSurat->jenis_id)
                           ->orderBy('sort_order')
                           ->get();

        // Debug: Uncomment ini untuk cek data
        // dd($mediaFiles);

        return view('pages.jenis_surat.show', compact('jenisSurat', 'mediaFiles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jenisSurat = JenisSurat::findOrFail($id);
        return view('pages.jenis_surat.edit', compact('jenisSurat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $jenisSurat = JenisSurat::findOrFail($id);

        $validated = $request->validate([
            'kode' => 'required|string|max:20|unique:jenis_surat,kode,' . $id . ',jenis_id',
            'nama_jenis' => 'required|string|max:100',
            'syarat_json' => 'nullable|string',
            'files.*' => 'nullable|mimes:jpg,jpeg,png,gif,webp,mp4,mov,avi,mkv,webm,pdf,doc,docx,zip|max:204800'
        ]);

        $jenisSurat->update($request->only(['kode', 'nama_jenis', 'syarat_json']));

        // === UPLOAD FILE KE TABLE MEDIA ===
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('uploads/jenis_surat', 'public');

                Media::create([
                    'ref_table' => 'jenis_surat',
                    'ref_id' => $jenisSurat->jenis_id,
                    'file_name' => $path,
                    'caption' => $request->input('caption'),
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => 0
                ]);
            }
        }

        return redirect()->route('admin.jenis-surat.index')
            ->with('success', 'Jenis surat berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jenisSurat = JenisSurat::findOrFail($id);

        // Hapus semua media terkait
        $mediaFiles = Media::where('ref_table', 'jenis_surat')
                           ->where('ref_id', $jenisSurat->jenis_id)
                           ->get();

        foreach ($mediaFiles as $media) {
            if (Storage::disk('public')->exists($media->file_name)) {
                Storage::disk('public')->delete($media->file_name);
            }
            $media->delete();
        }

        $jenisSurat->delete();

        return redirect()->route('admin.jenis-surat.index')
            ->with('success', 'Jenis surat berhasil dihapus!');
    }

    /**
     * Hapus file media spesifik
     */
    public function deleteMedia($id)
    {
        $media = Media::findOrFail($id);

        // Hapus file dari storage
        if (Storage::disk('public')->exists($media->file_name)) {
            Storage::disk('public')->delete($media->file_name);
        }

        $media->delete();

        return back()->with('success', 'File berhasil dihapus!');
    }
}
