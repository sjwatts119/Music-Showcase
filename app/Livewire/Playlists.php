<?php

namespace App\Livewire;

use Aerni\Spotify\Exceptions\SpotifyApiException;
use Aerni\Spotify\Facades\SpotifyFacade as Spotify;
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

//        $response = Spotify::playlist('60ORXGxg4FOducqNzl5jCr')
//            ->get();
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
