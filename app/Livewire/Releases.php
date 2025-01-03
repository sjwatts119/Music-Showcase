<?php

namespace App\Livewire;

use Aerni\Spotify\Exceptions\SpotifyApiException;
use Aerni\Spotify\Facades\SpotifyFacade as Spotify;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Releases extends Component
{
    /**
     * @throws SpotifyApiException
     */
    protected function getReleases(): array
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

    #[Layout('layouts.app')]
    public function render(): View
    {

        return view('livewire.releases')
            ->with([
                'releases' => $this->getReleases(),
            ]);
    }
}
