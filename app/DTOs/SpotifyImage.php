<?php

namespace App\DTOs;

readonly class SpotifyImage implements DataTransferObject
{
    public function __construct(
        public ?int $height,
        public ?int $width,
        public string $url,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            height: $data['height'],
            width: $data['width'],
            url: $data['url'],
        );
    }
}
