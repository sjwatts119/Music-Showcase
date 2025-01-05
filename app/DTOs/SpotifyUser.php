<?php

namespace App\DTOs;

readonly class SpotifyUser implements DataTransferObject
{
    public function __construct(
        public string $id,
        public string $displayName,
        public string $href,
        public string $uri,
        public string $type,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            displayName: $data['display_name'],
            href: $data['external_urls']['spotify'],
            uri: $data['uri'],
            type: $data['type'],
        );
    }
}
