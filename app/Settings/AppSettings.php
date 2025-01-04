<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AppSettings extends Settings
{
    public ?string $spotify_artist_id = null;
    public array $spotify_album_ids = [];

    public static function group(): string
    {
        return 'appSettings';
    }
}
