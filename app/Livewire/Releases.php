<?php

namespace App\Livewire;

use Aerni\Spotify\Exceptions\SpotifyApiException;
use App\Jobs\UpdateReleases;
use App\Models\Release;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Releases extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    /**
     * @throws SpotifyApiException
     */
    #[Layout('layouts.app')]
    public function render(): View
    {
        if(Release::first()?->created_at->diffInDays() > 1) {
            (new UpdateReleases())->handle();
        }

        $releases = Release::orderByDesc('release_date')
            ->with([
                'media',
                'artists',
            ])
            ->paginate(10);

        $newReleases = Release::orderByDesc('release_date')
            ->with([
                'media',
                'artists',
            ])
            ->newReleases()
            ->get();

        return view('livewire.releases')
            ->with([
                'releases' => $releases,
                'newReleases' =>  $newReleases,
            ]);
    }
}
