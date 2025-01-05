<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PlaylistOwner extends Model
{
    protected $fillable = [
        'spotify_id',
        'name',
        'type',
        'href',
        'uri'
    ];

    public function playlists(): HasMany
    {
        return $this->hasMany(Playlist::class, 'owner_id');
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediaModel');
    }
}
