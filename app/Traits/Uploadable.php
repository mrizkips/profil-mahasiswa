<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait Uploadable
{
    use Imageable;

    /**
     * Store file in storage.
     *
     * @param UploadedFile $file
     * @param string $path|null
     * @param string $disk
     * @return boolean|string
     */
    public function uploadFile(UploadedFile $file, $filename = null, $path = null, $disk = 'public')
    {
        if ($file->isValid()) {
            $set_name = ($filename ?? Str::random(30)) . '.' . $file->getClientOriginalExtension();
            return ($full_path = $file->storeAs($path, $set_name, $disk)) ? $full_path : false;
        }
        return false;
    }

    /**
     * Check file in storage.
     *
     * @param string $filename
     * @param string|null $path
     * @param string|null $disk
     * @return bool
     */
    public function existsFile($filename, $path = null, $disk = 'public')
    {
        $storage = Storage::disk($disk);
        $filepath = ($path != null ? $path . '/' : null) . $filename;
        return $storage->exists($filepath);
    }

    /**
     * Delete file in storage.
     *
     * @param string $filename
     * @param string|null $path
     * @param string|null $disk
     * @return boolean
     */
    public function deleteFile($filename, $path = null, $disk = 'public')
    {
        $storage = Storage::disk($disk);
        $filepath = ($path != null ? $path . '/' : null) . $filename;

        if ($storage->exists($filepath)) {
            return $storage->delete($filepath);
        }
        return false;
    }

    /**
     * Delete directory in storage.
     *
     * @param string $dir
     * @return bool
     */
    public function deleteDir($dir, $disk = 'public')
    {
        $storage = Storage::disk($disk);

        if ($storage->exists($dir)) {
            return $storage->deleteDirectory($dir);
        }

        return false;
    }
}
