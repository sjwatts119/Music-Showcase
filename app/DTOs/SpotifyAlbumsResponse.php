<?php

namespace App\DTOs;

use Illuminate\Support\Collection;

readonly class SpotifyAlbumsResponse
{
    public function __construct(
        public string $href,
        public int $limit,
        public ?string $next,
        public int $offset,
        public ?string $previous,
        public int $total,
        public Collection $items,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            href: $data['href'],
            limit: $data['limit'],
            next: $data['next'],
            offset: $data['offset'],
            previous: $data['previous'],
            total: $data['total'],
            items: collect($data['items'])->map(fn ($item) => SpotifyAlbum::fromArray($item))
        );
    }
}
