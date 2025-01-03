<?php

namespace App\Jobs;

use Aerni\Spotify\Exceptions\SpotifyApiException;
use App\DTOs\SpotifyAlbum;
use App\Models\Release;
use App\Traits\HasReleases;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateReleases implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, HasReleases;

    /**
     * @throws SpotifyApiException
     */
    public function handle(): void
    {
        $releases = $this->releases();

        foreach ($releases->items as $release) {
            $this->updateOrCreateRelease($release);
        }

        cache()->forget('releases');
    }

    private function updateOrCreateRelease(SpotifyAlbum $release): void
    {
        Release::updateOrCreate(
            ['spotify_id' => $release->id],
            [
                'name' => $release->name,
                'album_type' => $release->albumType,
                'total_tracks' => $release->totalTracks,
                'release_date' => $release->releaseDate,
                'image' => $release->image,
                'artists' => $release->artists->toArray(),
                'uri' => $release->uri,
                'href' => $release->href,
            ]
        );
    }
}
