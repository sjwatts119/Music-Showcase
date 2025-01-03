<?php

namespace App\Livewire;

use Aerni\Spotify\Exceptions\SpotifyApiException;
use App\Traits\HasReleases;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Releases extends Component
{
    use HasReleases;

    /**
     * @throws SpotifyApiException
     */
    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.releases')
            ->with([
                'releases' => $this->releases(),
            ]);
    }
}
