<?php

namespace App\Asteroide\Traits;

use Illuminate\Support\Facades\Storage;

trait DealWithFiles
{
    protected $anotherDisk = null;

    protected $anotherSecureDisk = null;

    public function disk()
    {
        return $this->anotherDisk ?? config('asteroide.public_storage');
    }

    public function secureDisk()
    {
        return $this->anotherSecureDisk ?? config('asteroide.private_storage');
    }

    public function saveFile($where, $file, $as = null)
    {
        return is_null($as) ? $file->storePublicly($where, $this->disk()) : $file->storePubliclyAs($where, $as, $this->disk());
    }

    public function saveSecureFile($where, $file, $as = null)
    {
        return is_null($as) ? $file->store($where, $this->secureDisk()) : $file->storeAs($where, $as, $this->secureDisk());
    }

    public function deleteFile($path)
    {
        if (filled($path)) {
            Storage::disk($this->disk())->delete($path);
        }
    }

    public function deleteSecureFile($path)
    {
        if (filled($path)) {
            Storage::disk($this->secureDisk())->delete($path);
        }
    }

    public function deleteDir($dir)
    {
        if (filled($dir)) {
            Storage::disk($this->disk())->deleteDirectory($dir);
        }
    }

    public function deleteSecureDir($dir)
    {
        if (filled($dir)) {
            Storage::disk($this->secureDisk())->deleteDirectory($dir);
        }
    }
}
