<div class="max-w-screen-lg m-auto px-4 py-8 md:px-8 space-y-8">
    <section id="my-playlists" class="space-y-4">
        <flux:heading size="xl" level="2">My Playlists</flux:heading>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-8">
            @foreach($playlists as $playlist)
                <div class="space-y-2">
                    <img src="{{ $playlist->media->first()->url}}"
                         alt="{{ $playlist->name }}"
                         class="w-full h-auto object-cover rounded-lg">

                    <div class="flex-grow flex flex-col gap-0.5">
                        <flux:link
                            :href="$playlist->href"
                            variant="ghost"
                            external
                            class="text-lg transition">
                            {{ $playlist->name }}
                        </flux:link>

                        <div class="flex flex-wrap gap-1">
                            <flux:link :href="$playlist->owner->href"
                                       class="text-md transition"
                                       variant="subtle"
                                       external>
                                {{ $playlist->owner->name }}
                            </flux:link>
                        </div>
{{--                        <p class="text-sm text-gray-500">{{ $playlist->playlist_date->diffForHumans() }}</p>--}}
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
