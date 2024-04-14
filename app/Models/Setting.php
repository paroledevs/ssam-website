<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'values',
    ];

    protected $casts = [
        'values' => 'array',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function scopeShipping($query)
    {
        return $query->where('key', 'FREE_SHIPPING');
    }

    public function value($prop)
    {
        return optional($this->values)[$prop];
    }

    public function boolean($prop)
    {
        return (bool) optional($this->values)[$prop];
    }
}
