<?php

namespace App\Models\Accessors;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait PostAccessors
{
    /**
     * Get the post's cover.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function cover(): Attribute
    {
        return new Attribute(
            get: fn () => $this->fileUrl('cover_image_path'),
        );
    }

    /**
     * Get the post's mainImage.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function mainImage(): Attribute
    {
        return new Attribute(
            get: fn () => $this->fileUrl('main_image_path'),
        );
    }

    /**
     * Get the post's link.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function link(): Attribute
    {
        return new Attribute(
            get: fn () => route('site.post', ['post' => $this]),
        );
    }

    /**
     * Get the post's category.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function category(): Attribute
    {
        return new Attribute(
            get: fn () => $this->postable,
        );
    }
}
