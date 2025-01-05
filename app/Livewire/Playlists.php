<?php

namespace App\Livewire;

use Aerni\Spotify\Exceptions\SpotifyApiException;
use App\Jobs\UpdatePlaylists;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Playlists extends Component
{
    /**
     * @throws SpotifyApiException
     */
    public function test(): void
    {
        (new UpdatePlaylists)->handle();
    }

    public function mount(): void
    {
        $this->test();
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.playlists');
    }
}
