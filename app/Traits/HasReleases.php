<?php

namespace App\Traits;

use Aerni\Spotify\Exceptions\SpotifyApiException;
use Aerni\Spotify\Facades\SpotifyFacade as Spotify;
use App\DTOs\SpotifyAlbumsResponse;
use Illuminate\Support\Facades\Cache;

trait HasReleases
{
    /**
     * @throws SpotifyApiException
     */
    protected function getReleasesResponse(): array
    {
        return Cache::flexible(
            key: 'releases',
            ttl: [now()->addHours(12), now()->addDay()],
            callback: function () {
                return Spotify::artistAlbums(config('app.artist_id'))
                    ->includeGroups('album,single')
                    ->get();
            });
    }

    /**
     * @throws SpotifyApiException
     */
    protected function releases(): SpotifyAlbumsResponse
    {
        return SpotifyAlbumsResponse::fromArray($this->getReleasesResponse());
    }
}
