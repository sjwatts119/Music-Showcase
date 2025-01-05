<?php

namespace App\Livewire;

use Aerni\Spotify\Exceptions\SpotifyApiException;
use App\Jobs\UpdatePlaylists;
use App\Models\Playlist;
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
        if (Playlist::count() === 0 || Playlist::first()->created_at->diffInDays() > 1) {
            (new UpdatePlaylists)->handle();
        }
    }

    public function mount(): void
    {
        $this->test();
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        $playlists = Playlist::query()
            ->with([
                'media',
                'owner',
            ])
            ->get();

        return view('livewire.playlists')
            ->with([
                'playlists' => $playlists,
            ]);
    }
}
