<?php

namespace App\DTOs;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class SpotifyPlaylist
{
    public function __construct(
        public string $id,
        public string $name,
        public string $albumType,
        public int $totalTracks,
        public string $href,
        public Carbon $releaseDate,
        public Collection $images,
        public Collection $artists,
        public string $uri,
        public string $albumGroup,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            albumType: $data['album_type'],
            totalTracks: $data['total_tracks'],
            href: $data['external_urls']['spotify'],
            releaseDate: Carbon::parse($data['release_date']),
            images: collect($data['images'])->map(fn ($image) => SpotifyImage::fromArray($image)),
            artists: collect($data['artists'])->map(fn ($artist) => SpotifyArtist::fromArray($artist)),
            uri: $data['uri'],
            albumGroup: $data['album_group']
        );
    }
}
