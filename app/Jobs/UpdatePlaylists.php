<?php

namespace App\Jobs;

use App\DTOs\SpotifyPlaylist;
use App\Models\Media;
use App\Models\Playlist;
use App\Models\PlaylistOwner;
use App\Traits\HasPlaylists;
use Croustibat\FilamentJobsMonitor\Traits\QueueProgress;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class UpdatePlaylists implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, QueueProgress, SerializesModels, HasPlaylists;

    public function handle(): void
    {
        $this->setProgress(0);

        if(!$this->playlistsAreSet()) {
            return;
        }

        $this->setProgress(10);

        $this->bustPlaylistsCache();

        $this->setProgress(30);

        DB::transaction(function () {
            $this->deleteAllPlaylists();

            $this->setProgress(50);

            $playlists = $this->playlists();

            $this->setProgress(70);

            foreach ($playlists as $playlist) {
                $this->createPlaylist($playlist);
            }
        });

        $this->setProgress(100);
    }

    private function createPlaylist(SpotifyPlaylist $playlist): void
    {
        $owner = PlaylistOwner::updateOrCreate(
            ['spotify_id' => $playlist->owner->id],
            [
                'name' => $playlist->owner->displayName,
                'href' => $playlist->owner->href,
            ]
        );

        $newPlaylist = Playlist::create([
            'owner_id' => $owner->id,
            'spotify_id' => $playlist->id,
            'name' => $playlist->name,
            'description' => $playlist->description ?? '',
            'collaborative' => $playlist->collaborative,
            'href' => $playlist->href,
            'primary_color' => $playlist->primaryColor,
            'public' => $playlist->public,
            'snapshot_id' => $playlist->snapshotId,
            'tracks' => $playlist->tracks['total'],
            'uri' => $playlist->uri,
            'followers' => $playlist->followers['total'],
        ]);

        foreach ($playlist->images as $image) {
            $newPlaylist->media()->create(['url' => $image->url]);
        }
    }

    private function deleteAllPlaylists(): void
    {
        Playlist::truncate();
        PlaylistOwner::truncate();
        Media::query()->where('mediaModel_type', Playlist::class)->delete();
    }
}
