<?php

namespace App\DTOs;

use Illuminate\Support\Collection;

readonly class SpotifyPlaylist implements DataTransferObject
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        public bool $collaborative,
        public string $href,
        public Collection $images,
        public SpotifyUser $owner,
        public ?string $primaryColor,
        public bool $public,
        public string $snapshotId,
        public array $tracks,
        public string $type,
        public string $uri,
        public array $followers,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            description: $data['description'],
            collaborative: $data['collaborative'],
            href: $data['external_urls']['spotify'],
            images: collect($data['images'])->map(fn ($image) => SpotifyImage::fromArray($image)),
            owner: SpotifyUser::fromArray($data['owner']),
            primaryColor: $data['primary_color'],
            public: $data['public'],
            snapshotId: $data['snapshot_id'],
            tracks: $data['tracks'],
            type: $data['type'],
            uri: $data['uri'],
            followers: $data['followers'],
        );
    }
}
