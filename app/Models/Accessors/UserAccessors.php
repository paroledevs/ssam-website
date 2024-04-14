<?php

namespace App\Models\Accessors;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait UserAccessors
{
    /**
     * Get the user's avatar.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function avatar(): Attribute
    {
        return new Attribute(
            get: fn ($value, $attributes) => $this->fileUrl('avatar_path'),
        );
    }
}
