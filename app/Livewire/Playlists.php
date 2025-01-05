<?php

namespace App\Livewire;

use Aerni\Spotify\Exceptions\SpotifyApiException;
use App\Jobs\UpdatePlaylists;
use App\Models\Playlist;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Playlists extends Component
{
    #[Locked]
    public int $perPage = 18;

    public function loadMore(): void
    {
        $this->perPage += 18;
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        $playlists = Playlist::query()
            ->with([
                'media',
                'owner',
            ])
            ->paginate($this->perPage);

        return view('livewire.playlists')
            ->with([
                'playlists' => $playlists,
            ]);
    }
}
