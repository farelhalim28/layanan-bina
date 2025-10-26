<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media = Media::orderBy('sort_order', 'asc')
                      ->orderBy('created_at', 'desc')
                      ->get();

        return view('admin.media.index', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ref_table' => 'required|string|max:50',
            'ref_id' => 'required|integer',
            'file' => 'required|file|max:10240', // max 10MB
            'caption' => 'nullable|string|max:200',
            'sort_order' => 'nullable|integer',
        ]);

        // Upload file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('media', 'public');

            $validated['file_url'] = $path;
            $validated['mime_type'] = $file->getMimeType();
        }

        // Set default sort_order jika kosong
        if (empty($validated['sort_order'])) {
            $validated['sort_order'] = 0;
        }

        Media::create($validated);

        return redirect()->route('admin.media.index')
            ->with('success', 'Media berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $media = Media::findOrFail($id);
        return view('admin.media.show', compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $media = Media::findOrFail($id);
        return view('admin.media.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);

        $validated = $request->validate([
            'ref_table' => 'required|string|max:50',
            'ref_id' => 'required|integer',
            'file' => 'nullable|file|max:10240', // max 10MB
            'caption' => 'nullable|string|max:200',
            'sort_order' => 'nullable|integer',
        ]);

        // Upload file baru jika ada
        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($media->file_url && Storage::disk('public')->exists($media->file_url)) {
                Storage::disk('public')->delete($media->file_url);
            }

            $file = $request->file('file');
            $path = $file->store('media', 'public');

            $validated['file_url'] = $path;
            $validated['mime_type'] = $file->getMimeType();
        }

        // Set default sort_order jika kosong
        if (empty($validated['sort_order'])) {
            $validated['sort_order'] = 0;
        }

        $media->update($validated);

        return redirect()->route('admin.media.index')
            ->with('success', 'Media berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        // Hapus file dari storage
        if ($media->file_url && Storage::disk('public')->exists($media->file_url)) {
            Storage::disk('public')->delete($media->file_url);
        }

        $media->delete();

        return redirect()->route('admin.media.index')
            ->with('success', 'Media berhasil dihapus!');
    }
}
