<?php

namespace App\Models;

use App\Asteroide\Traits\FileUrls;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use FileUrls;

    /**
     * Valid layouts ['text', 'quote', 'list',]
     *
     * @var array
     */
    protected $fillable = [
        'layout',
        'position',
        'content',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'content' => 'json',
    ];

    public function blockable()
    {
        return $this->morphTo();
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function scopePreviousTo($query, $block)
    {
        return $query
            ->where('blockable_id', $block->blockable_id)
            ->where('blockable_type', $block->blockable_type)
            ->where('position', '<', $block->position)
            ->orderBy('position', 'desc');
    }

    public function scopeNextTo($query, $block)
    {
        return $query
            ->where('blockable_id', $block->blockable_id)
            ->where('blockable_type', $block->blockable_type)
            ->where('position', '>', $block->position)
            ->orderBy('position', 'asc');
    }

    public function extractContent($prop = null)
    {
        return optional(json_decode($this->content))->{$prop} ?? $this->content;
    }

    public function boolean($prop)
    {
        return (bool) optional(json_decode($this->content))->{$prop};
    }

    public function is($layout)
    {
        return $this->layout == $layout;
    }

    public function cover()
    {
        return $this->disk()->url($this->extractContent('cover_image_path'));
    }

    public function mapContent()
    {
        switch ($this->layout) {
            case 'text':
            case 'quote':
            case 'title':
                return [
                    'text' => $this->extractContent('text'),
                ];
                break;

            case 'image':
                return [
                    'photo_info' => $this->extractContent('photo_info'),
                    'cover' => $this->cover(),
                ];
                break;

            case 'link':
                return [
                    'link' => $this->extractContent('link'),
                    'link_button' => $this->extractContent('link_button'),
                    'link_text' => $this->extractContent('link_text'),
                ];

            case 'video':
                return [
                    'video_url' => $this->extractContent('video_url'),
                    'video_description' => $this->extractContent('video_description'),
                ];
                break;

            case 'list':
                return [
                    'text' => is_array($this->extractContent('items')) ? implode("\r\n", $this->extractContent('items')) : '',
                    'items' => $this->extractContent('items'),
                ];
                break;

            default:
                return [];
                break;
        }
    }
}
