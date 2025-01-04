<?php

namespace App\Jobs;

use Aerni\Spotify\Exceptions\SpotifyApiException;
use App\DTOs\SpotifyRelease;
use App\Models\Artist;
use App\Models\Media;
use App\Models\Release;
use App\Traits\HasReleases;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class UpdateReleases implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, HasReleases;

    /**
     * @throws SpotifyApiException
     */
    public function handle(): void
    {
//        if(Release::first()?->created_at->diffInDays() < 1) {
//            return;
//        }

        $releases = $this->releases();

        DB::transaction(function () use ($releases) {
            $this->deleteAllReleases();

            foreach ($releases as $release) {
                $this->updateOrCreateRelease($release);
            }
        });

        cache()->forget('releases');
    }

    private function updateOrCreateRelease(SpotifyRelease $release): void
    {
        $newRelease = Release::updateOrCreate(
            ['spotify_id' => $release->id],
            [
                'name' => $release->name,
                'album_type' => $release->albumType,
                'total_tracks' => $release->totalTracks,
                'release_date' => $release->releaseDate,
                'uri' => $release->uri,
                'href' => $release->href,
            ]
        );

        foreach ($release->images as $image) {
            $newRelease->media()->updateOrCreate(
                ['url' => $image->url],
                ['url' => $image->url]
            );
        }

        $artistIds = [];
        foreach ($release->artists as $artistData) {
            $artist = Artist::updateOrCreate(
                ['spotify_id' => $artistData->id],
                [
                    'name' => $artistData->name,
                    'href' => $artistData->href,
                ]
            );
            $artistIds[] = $artist->id;
        }

        $newRelease->artists()->syncWithoutDetaching($artistIds);
    }

    private function deleteAllReleases(): void
    {
        Release::query()->delete();
        Artist::query()->delete();
        Media::query()->delete();
    }
}
