<div class="space-y-8">
    @if(isset($newReleases) && $newReleases->count() > 2)
        <section id="new-releases" class="space-y-4">
            <flux:heading size="xl" level="2">Latest Releases</flux:heading>
            <x-app.carousel>
                @foreach ($newReleases as $newRelease)
                    <x-app.carousel.slide class="w-full rounded-2xl overflow-hidden border-2 border-zinc-700/50 shadow-lg">
                        <div class="bg-zinc-800 p-2 sm:h-60 flex gap-8">
                            <a href="{{ $newRelease->href }}">
                                <img loading="lazy"
                                     src="{{ $newRelease->media->first()->url }}"
                                     alt="{{ $newRelease->name ?? 'Slide ' . $loop->index + 1 }}"
                                     class="object-cover h-full rounded-lg" />
                            </a>
                            <div class="flex flex-col justify-center gap-y-1 max-sm:hidden pr-4">
                                <flux:link :href="$newRelease->href"
                                           variant="ghost"
                                           class="text-3xl lg:text-4xl transition"
                                           external>
                                    {{ $newRelease->name }}
                                </flux:link>

                                <div class="flex flex-wrap gap-1">
                                    @foreach($newRelease->artists as $index => $artist)
                                        <flux:link :href="$artist->href"
                                                   class="text-md transition"
                                                   variant="subtle"
                                                   external>
                                            {{ $artist->name }}{{ $index + 1 < count($newRelease->artists) ? ',' : '' }}
                                        </flux:link>
                                    @endforeach
                                </div>
                                <p class="text-sm text-gray-500">{{ $newRelease->release_date->diffForHumans() }}</p>
                            </div>
                        </div>
                    </x-app.carousel.slide>
                @endforeach

                <x-slot:controls>
                    <div class="flex items-center justify-between">
                        <div data-glide-el="controls[nav]" class="flex gap-1">
                            @foreach ($newReleases as $index => $newRelease)
                                <button type="button"
                                        data-glide-dir="={{ $index }}"
                                        title="Go to slide {{ $index + 1 }}"
                                        class="w-3 h-3 transition-colors rounded-full bg-zinc-700"/>
                            @endforeach
                        </div>
                        <div data-glide-el="controls">
                            <flux:button data-glide-dir="<" variant="ghost" icon="chevron-left" class="transition" />

                            <flux:button data-glide-dir=">" variant="ghost" icon="chevron-right" class="transition" />
                        </div>
                    </div>
                </x-slot:controls>
            </x-app.carousel>
        </section>
    @endif

    <section id="all-releases" class="space-y-4">
        <flux:heading size="xl" level="2">All Releases</flux:heading>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-8">
            @foreach($releases as $release)
                <div class="space-y-2">
                    <img src="{{ $release->media->first()->url}}"
                         alt="{{ $release->name }}"
                         class="w-full h-auto object-cover rounded-lg">

                    <div class="flex-grow flex flex-col gap-0.5">
                        <flux:link
                            :href="$release->href"
                            variant="ghost"
                            external
                            class="text-lg transition">
                            {{ $release->name }}
                        </flux:link>

                        <div class="flex flex-wrap gap-1">
                            @foreach($release->artists as $loop->iteration => $artist)
                                <flux:link :href="$artist->href"
                                           class="text-sm transition"
                                           variant="subtle"
                                           external>
                                    {{ $artist->name }}{{ $loop->iteration < count($release->artists) ? ',' : '' }}
                                </flux:link>
                            @endforeach
                        </div>
                        <p class="text-sm text-gray-500">{{ $release->release_date->diffForHumans() }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
