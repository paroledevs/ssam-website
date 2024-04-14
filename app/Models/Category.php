<?php

namespace App\Models;

use App\Asteroide\Traits\SlugRouting;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use SlugRouting;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
    ];

    /**
     * Get all of the dishes for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }

    /**
     * Get the category's link.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function link(): Attribute
    {
        return new Attribute(
            get: fn () => route('site.menu', [
                'category' => $this->slug,
            ]),
        );
    }
}
