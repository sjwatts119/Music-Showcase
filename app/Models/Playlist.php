<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Playlist extends Model
{
    protected $fillable = [
        'owner_id',
        'spotify_id',
        'name',
        'description',
        'collaborative',
        'href',
        'primary_color',
        'public',
        'snapshot_id',
        'tracks',
        'uri',
        'followers',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(PlaylistOwner::class);
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediaModel');
    }
}
