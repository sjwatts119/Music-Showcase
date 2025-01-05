<?php

namespace App\Jobs;

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

    public function handle(): void
    {
        if(!$this->artistIsSet()) {
            return;
        }

        $this->bustReleasesCache();

        DB::transaction(function () {
            $this->deleteAllReleases();

            $releases = $this->releases();

            foreach ($releases as $release) {
                $this->createRelease($release);
            }
        });
    }

    private function createRelease(SpotifyRelease $release): void
    {
        $newRelease = Release::create([
            'spotify_id' => $release->id,
            'name' => $release->name,
            'album_type' => $release->albumType,
            'total_tracks' => $release->totalTracks,
            'href' => $release->href,
            'release_date' => $release->releaseDate,
            'uri' => $release->uri,
            'album_group' => $release->albumGroup,
        ]);

        foreach ($release->images as $image) {
            $newRelease->media()->create(
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

        $newRelease->artists()->sync($artistIds);
    }

    private function deleteAllReleases(): void
    {
        Release::truncate();
        Artist::truncate();
        Media::query()->where('mediaModel_type', Release::class)->delete();
    }
}
