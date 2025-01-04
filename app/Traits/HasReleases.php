<?php

namespace App\Traits;

use Aerni\Spotify\Exceptions\SpotifyApiException;
use Aerni\Spotify\Facades\SpotifyFacade as Spotify;
use App\DTOs\SpotifyRelease;
use App\DTOs\SpotifyReleasesResponse;
use Illuminate\Support\Collection;
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
                $items = collect();

                do {
                    $response = Spotify::artistAlbums(config('app.artist_id'))
                        ->limit(50)
                        ->offset($items->count())
                        ->includeGroups('album,single')
                        ->get();

                    $items->push(...$response['items']);
                } while ($response['next']);

                return $items->all();
            });
    }

    /**
     * @throws SpotifyApiException
     */
    protected function releases(): Collection
    {
        return collect($this->getReleasesResponse())
            ->map(fn ($release) => SpotifyRelease::fromArray($release));
    }
}
