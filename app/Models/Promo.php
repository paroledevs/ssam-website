<?php

namespace App\Models;

use App\Asteroide\Traits\FileUrls;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use FileUrls;

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'text',
        'cover_image_path',
    ];

    /**
     * The accessors to append to the model’s array form.
     *
     * @var array<string>
     */
    protected $appends = [
        'cover',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'cover_image_path',
    ];

    /**
     * Get the promo's cover.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function cover(): Attribute
    {
        return new Attribute(
            get: fn () => $this->fileUrl('cover_image_path'),
        );
    }
}
