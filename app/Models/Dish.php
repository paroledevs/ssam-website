<?php

namespace App\Models;

use App\Asteroide\Traits\FileUrls;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dish extends Model
{
    use FileUrls;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'description',
        'show_in_menu',
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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'show_in_menu' => 'boolean',
    ];

    /**
     * Get the category that owns the Dish
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the dish's cover.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function cover(): Attribute
    {
        return new Attribute(
            get: fn () => $this->fileUrl('cover_image_path'),
        );
    }
}
