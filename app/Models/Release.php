<?php

namespace App\Models;

use App\Traits\HasTimestampScopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Release extends Model
{
    use HasTimestampScopes;

    protected $casts = [
        'release_date' => 'date',
    ];

    protected $fillable = [
        'spotify_id',
        'name',
        'album_type',
        'total_tracks',
        'release_date',
        'image',
        'artists',
        'uri',
        'href',
    ];

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediaModel');
    }

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class);
    }

    /*
     * Get the last 6 releases
     */
    public function scopeLatestReleases(Builder $query): Builder
    {
        return $query->latest()->limit(6);
    }
}
