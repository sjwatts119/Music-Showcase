<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('appSettings.spotify_artist_id', null);
        $this->migrator->add('appSettings.spotify_playlist_ids', []);
    }
};
