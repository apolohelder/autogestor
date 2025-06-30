<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PhotoUploadService
{
    public function upload(UploadedFile $file, $folder = 'users')
    {
        return $file->store($folder, 'public');
    }

    public function delete($path)
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}