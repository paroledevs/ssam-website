<?php

namespace App\Models;

use App\Asteroide\Traits\FileUrls;
use App\Asteroide\Traits\RouteHelpers;
use App\Asteroide\Traits\SlugRouting;
use App\Models\Accessors\PostAccessors;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory,
        SlugRouting,
        Searchable,
        FileUrls,
        RouteHelpers,
        PostAccessors;

    /**
     * visibility options ['everyone', 'no_one']
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'main_image_path',
        'cover_image_path',
        'visibility',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->toArray() + [
            //
        ];
    }

    public function postable()
    {
        return $this->morphTo();
    }

    /**
     * Get all the blocks of the post
     */
    public function blocks()
    {
        return $this->morphMany(Block::class, 'blockable');
    }

    /**
     * Get all the images of the post
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function storagePath($for = null)
    {
        switch ($for) {
            case 'content':
                return "posts/{$this->id}/content";
                break;

            default:
                return "posts/{$this->id}";
                break;
        }
    }

    public function isVisibleFor($visibility)
    {
        return $this->visibility === $visibility;
    }

    public function is($type)
    {
        return $this->type === $type;
    }

    public function blockRoutes()
    {
        return $this->getRoutesFor('blocks', ['block' => 'ID'], ['except' => ['site', 'show']]);
    }

    public function scopeForEveryone($query)
    {
        return $query->orderBy('created_at', 'desc')
            ->where('visibility', '<>', 'no_one')
            ->where('visibility', 'everyone');
    }

    public function scopeForMembers($query)
    {
        return $query->orderBy('created_at', 'desc')
            ->where('visibility', '<>', 'no_one')
            ->where(function ($query) {
                $query->where('visibility', 'everyone')
                    ->orWhere('visibility', 'members');
            });
    }

    public function previewText()
    {
        $block = $this->blocks()
            ->orderBy('position')
            ->where('layout', 'text')
            ->first();

        return optional($block)->extractContent('text');
    }
}
