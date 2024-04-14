<?php

namespace App\Models;

use App\Asteroide\Traits\SlugRouting;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PostCategory extends Model
{
    use SlugRouting,
        SluggableScopeHelpers;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
    ];

    /**
     * Get all of the posts for the PostCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function posts(): MorphMany
    {
        return $this->morphMany(Post::class, 'postable');
    }

    /**
     * Get the postCategory's link.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function link(): Attribute
    {
        return new Attribute(
            get: fn () => route('site.blog', [
                'c' => $this->slug,
            ]),
        );
    }
}
