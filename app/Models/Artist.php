<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Artist extends Model
{
    protected $fillable = [
        'spotify_id',
        'name',
        'href',
    ];

    public function releases(): BelongsToMany
    {
        return $this->belongsToMany(Release::class);
    }
}
