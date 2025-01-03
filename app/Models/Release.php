<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Release extends Model
{
    use Prunable;

    protected $casts = [
        'release_date' => 'date',
        'images' => 'array',
        'artists' => 'array',
        'metadata' => 'array',
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

    public function prunable()
    {
        return static::where('created_at', '<=', now()->subWeek());
    }
}
