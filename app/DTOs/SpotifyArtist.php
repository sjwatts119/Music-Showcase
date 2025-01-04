<?php

namespace App\DTOs;

readonly class SpotifyArtist
{
    public function __construct(
        public string $id,
        public string $name,
        public string $uri,
        public string $href,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            uri: $data['uri'],
            href: $data['external_urls']['spotify']
        );
    }
}
