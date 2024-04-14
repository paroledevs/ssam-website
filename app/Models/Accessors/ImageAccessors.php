<?php

namespace App\Models\Accessors;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait ImageAccessors
{
    /**
     * Get the customimageer's url.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function url(): Attribute
    {
        return new Attribute(
            get: fn () => $this->fileUrl('path'),
        );
    }

    /**
     * Get the image's cover.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function cover(): Attribute
    {
        return new Attribute(
            get: fn () => $this->fileUrl('path'),
        );
    }
}
