<?php

namespace App\Models;

use App\Asteroide\Traits\FileUrls;
use App\Models\Accessors\ImageAccessors;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use FileUrls,
        ImageAccessors;

    protected $fillable = [
        'path',
        'is_cover',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'path',
    ];

    protected $appends = [
        'url',
        'cover',
    ];

    protected $casts = [
        'is_cover' => 'boolean',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function scopeCovers($query)
    {
        $query->where('is_cover', true);
    }
}
