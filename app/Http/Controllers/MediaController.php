<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::orderBy('created_at', 'desc')->paginate(20);
        return view('pages.media.index', compact('media'));
    }

    public function create()
    {
        return view('pages.media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ref_table' => 'required|string',
            'ref_id' => 'required|integer',
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,webp,svg,mp4,mov,avi,mkv,webm,pdf,doc,docx,zip|max:204800',
            'caption' => 'nullable|string',
            'sort_order' => 'nullable|integer'
        ]);

        $file = $request->file('file');
        $path = $file->store('uploads/media', 'public');

        Media::create([
            'ref_table' => $request->ref_table,
            'ref_id' => $request->ref_id,
            'file_name' => $path,
            'mime_type' => $file->getMimeType(),
            'caption' => $request->caption,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.media.index')
            ->with('success', 'Media berhasil ditambahkan.');
    }

    public function show($id)
    {
        $media = Media::findOrFail($id);
        return view('pages.media.show', compact('media'));
    }

    public function edit($id)
    {
        $media = Media::findOrFail($id);
        return view('pages.media.edit', compact('media'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'caption' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,svg,mp4,mov,avi,mkv,webm,pdf,doc,docx,zip|max:204800'
        ]);

        $media = Media::findOrFail($id);

        if ($request->hasFile('file'))
        {
            if (Storage::disk('public')->exists($media->file_name)) {
                Storage::disk('public')->delete($media->file_name);
            }

            $file = $request->file('file');
            $path = $file->store('uploads/media', 'public');

            $media->file_name = $path;
            $media->mime_type = $file->getMimeType();
        }

        $media->caption = $request->caption;
        $media->sort_order = $request->sort_order ?? 0;
        $media->save();

        return redirect()->route('admin.media.index')
            ->with('success', 'Media berhasil diupdate.');
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        if (Storage::disk('public')->exists($media->file_name)) {
            Storage::disk('public')->delete($media->file_name);
        }

        $media->delete();

        return redirect()->route('admin.media.index')
            ->with('success', 'Media berhasil dihapus.');
    }
}
