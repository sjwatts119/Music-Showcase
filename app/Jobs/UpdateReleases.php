<?php

namespace App\Jobs;

use App\DTOs\SpotifyRelease;
use App\Models\Artist;
use App\Models\Media;
use App\Models\Release;
use App\Traits\HasReleases;
use Croustibat\FilamentJobsMonitor\Traits\QueueProgress;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class UpdateReleases implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, QueueProgress, SerializesModels, HasReleases;

    public function handle(): void
    {
        $this->setProgress(0);

        if(!$this->artistIsSet()) {
            return;
        }
        $this->setProgress(10);

        $this->bustReleasesCache();
        $this->setProgress(30);

        DB::transaction(function () {
            $this->deleteAllReleases();
            $this->setProgress(50);

            $releases = $this->releases();
            $this->setProgress(70);

            foreach ($releases as $release) {
                $this->createRelease($release);
            }
        });

        $this->setProgress(100);
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
