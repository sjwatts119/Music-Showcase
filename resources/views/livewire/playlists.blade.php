<div class="space-y-8">
    <section id="my-playlists" class="space-y-4">
        <flux:heading size="xl" level="2">Featured Playlists</flux:heading>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-8">
            @foreach($playlists as $playlist)
                <div class="space-y-2">
                    <img src="{{ $playlist->media->first()->url}}"
                         alt="{{ $playlist->name }}"
                         class="w-full aspect-square object-cover rounded-lg">

                    <div class="flex-grow flex flex-col gap-0.5">
                        <flux:link
                            :href="$playlist->href"
                            variant="ghost"
                            external
                            class="text-lg transition">
                            {{ $playlist->name }}
                        </flux:link>

                        <flux:link :href="$playlist->owner->href"
                                   class="text-md transition"
                                   variant="subtle"
                                   external>
                            {{ $playlist->owner->name }}
                        </flux:link>

                        <p class="text-sm text-gray-500">{{ number_format($playlist->tracks) }} tracks</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
