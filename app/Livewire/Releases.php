<?php

namespace App\Livewire;

use Aerni\Spotify\Exceptions\SpotifyApiException;
use App\Jobs\UpdateReleases;
use App\Models\Release;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Releases extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    #[Locked]
    public int $perPage = 18;

    public function loadMore(): void
    {
        $this->perPage += 18;
    }

    /**
     * @throws SpotifyApiException
     */
    #[Layout('layouts.app')]
    public function render(): View
    {
        if(Release::count() === 0 || Release::first()->created_at->diffInDays() > 1) {
            (new UpdateReleases())->handle();
        }

        $releases = Release::orderByDesc('release_date')
            ->orderByDesc('spotify_id')
            ->with([
                'media',
                'artists',
            ])
            ->simplePaginate($this->perPage);

        $newReleases = Release::orderByDesc('release_date')
            ->with([
                'media',
                'artists',
            ])
            ->latestReleases()
            ->get();

        return view('livewire.releases')
            ->with([
                'releases' => $releases,
                'newReleases' =>  $newReleases,
            ]);
    }
}
