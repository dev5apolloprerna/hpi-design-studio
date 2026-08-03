<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (! function_exists('upload_file')) {
    /**
     * Store an uploaded file on the "public" disk inside the given folder
     * and return the relative path that should be saved in the database.
     */
    function upload_file(UploadedFile $file, string $folder = 'uploads'): string
    {
        $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();

        return $file->storeAs($folder, $filename, 'public');
    }
}

if (! function_exists('delete_uploaded_file')) {
    /**
     * Delete a previously uploaded file from the "public" disk if it exists.
     */
    function delete_uploaded_file(?string $path): bool
    {
        if (! empty($path) && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }
}
