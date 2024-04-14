<?php

namespace App\Asteroide\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;

class Activity extends Model
{
    use Searchable;

    protected $fillable = [
        'url',
        'method',
        'ip',
        'agent',
        'action',
        'performed_on_model',
        'performed_on_class',
        'payload',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'updated_at',
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    #[SearchUsingFullText(['payload'])]
    public function toSearchableArray()
    {
        return $this->toArray() + [
            // Customize the data array...
        ];
    }

    public function causedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
