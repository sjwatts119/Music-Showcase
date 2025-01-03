<?php

namespace App\DTOs;

readonly class SpotifyImage
{
    public function __construct(
        public string $url,
        public int $height,
        public int $width
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            url: $data['url'],
            height: $data['height'],
            width: $data['width']
        );
    }
}
