<?php

namespace App\Livewire;

use Aerni\Spotify\Exceptions\SpotifyApiException;
use App\Jobs\UpdateReleases;
use App\Models\Artist;
use App\Models\Release;
use App\Traits\HasReleases;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Releases extends Component
{
    /**
     * @throws SpotifyApiException
     */
    #[Layout('layouts.app')]
    public function render(): View
    {
        (new UpdateReleases())->handle();

        $releases = Release::with('artists')
            ->paginate(10);

        return view('livewire.releases')
            ->with([
                'releases' => $releases,
            ]);
    }
}
