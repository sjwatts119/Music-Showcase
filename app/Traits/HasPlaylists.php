<?php

namespace App\Traits;

use Aerni\Spotify\Facades\SpotifyFacade as Spotify;
use App\DTOs\SpotifyPlaylist;
use App\Settings\AppSettings;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

trait HasPlaylists
{
    protected function getPlaylistsResponse(): Collection
    {
        return Cache::flexible(
            key: 'playlists',
            ttl: [now()->addHours(12), now()->addDay()],
            callback: function () {
                $playlists = collect();
                $playlistIds = app(AppSettings::class)->spotify_playlist_ids;

                foreach ($playlistIds as $playlistId) {
                    $response = Spotify::playlist($playlistId['id'])
                        ->get();

                    $playlists->push($response);
                }

                return $playlists;
            });
    }

    public function playlists(): Collection
    {
        return collect($this->getPlaylistsResponse())
            ->map(fn ($release) => SpotifyPlaylist::fromArray($release));
    }
}
