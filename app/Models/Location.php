<?php

namespace App\Models;

use App\Asteroide\Traits\FileUrls;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use FileUrls;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'address',
        'timetable',
        'contact',
        'link',
		'book',
        'cover_image_path',
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
     * The accessors to append to the model’s array form.
     *
     * @var array<string>
     */
    protected $appends = [
        'cover',
    ];

    /**
     * Get the location's cover.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function cover(): Attribute
    {
        return new Attribute(
            get: fn ($value, $attributes) => $this->fileUrl('cover_image_path'),
        );
    }
}
