<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MultipleUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MultipleUploadController extends Controller
{
    /**
     * Store multiple uploaded files
     */
    public function store(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|mimes:jpg,jpeg,png,gif,webp,mp4,mov,avi,mkv,webm,pdf,doc,docx,xls,xlsx,zip|max:204800',
            'ref_table' => 'required|string',
            'ref_id' => 'required|integer'
        ]);

        $uploadedFiles = [];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('uploads/' . $request->ref_table, 'public');

                $upload = MultipleUpload::create([
                    'filename' => $file->hashName(),
                    'original_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'ref_table' => $request->ref_table,
                    'ref_id' => $request->ref_id
                ]);

                $uploadedFiles[] = $upload;
            }
        }

        return back()->with('success', 'File berhasil diupload!');
    }

    /**
     * Remove the specified file
     */
    public function destroy($id)
    {
        $file = MultipleUpload::findOrFail($id);

        // Hapus file dari storage
        if (Storage::disk('public')->exists($file->file_path)) {
            Storage::disk('public')->delete($file->file_path);
        }

        // Hapus record dari database
        $file->delete();

        return back()->with('success', 'File berhasil dihapus!');
    }
}
