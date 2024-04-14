<?php

namespace App\Asteroide\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

trait FileUrls
{
    protected $anotherDisk = null;

    public function disk()
    {
        return Storage::disk($this->anotherDisk ?? env('FILESYSTEM_DISK', 'public'));
    }

    public function secureDisk()
    {
        return Storage::disk($this->anotherDisk ?? 's3_secure');
    }

    protected function fileUrl($field)
    {
        return filled($this->{$field}) ? $this->disk()->url($this->{$field}) : null;
    }

    protected function secureFileUrl($field, $expiration = null)
    {
        $expiration = $expiration instanceof Carbon ? $expiration : now()->addMinutes(5);

        return filled($this->{$field}) ?
            $this->secureDisk($this->{$field})->temporaryUrl($this->{$field}, $expiration)
            : null;
    }
}
