<div class="max-w-screen-lg m-auto p-4 md:p-8 space-y-8">
    <x-app.carousel>
        @foreach ($newReleases as $heroImage)
            <x-app.carousel.slide class="w-full rounded-lg overflow-hidden">
                <img loading="lazy"
                     src="{{ $heroImage->media->first()->url }}"
                     alt="{{ $heroImage->name ?? 'Slide ' . $loop->index + 1 }}"
                     class="object-cover w-full">
            </x-app.carousel.slide>
        @endforeach

        <x-slot:controls>
            <div class="flex items-center justify-between">
                <div data-glide-el="controls[nav]" class="flex gap-1">
                    @foreach ($newReleases as $index => $heroImage)
                        <button type="button"
                                data-glide-dir="={{ $index }}"
                                title="Go to slide {{ $index + 1 }}"
                                class="w-3 h-3 transition-colors rounded-full bg-zinc-700"/>
                    @endforeach
                </div>
                <div data-glide-el="controls">
                    <flux:button data-glide-dir="<" variant="ghost" icon="chevron-left"/>

                    <flux:button data-glide-dir=">" variant="ghost" icon="chevron-right"/>
                </div>
            </div>
        </x-slot:controls>
    </x-app.carousel>

    <div class="space-y-4">
        <flux:heading size="xl" level="2">New Releases</flux:heading>
        @foreach($newReleases as $release)
            <div class="flex gap-4">
                <div class="flex-shrink">
                    <a href="{{ $release->href }}">
                        <img src="{{ $release->media->first()->url}}"
                             alt="{{ $release->name }}"
                             class="w-24 h-24 rounded-lg"
                        >
                    </a>
                </div>
                <div class="flex-grow flex flex-col gap-1">
                    <flux:link :href="$release->href" variant="ghost" external>
                        {{ $release->name }}
                    </flux:link>

                    <div class="flex space-x-1">
                        @foreach($release->artists as $artist)
                            <flux:link :href="$artist->href"
                                       class="text-sm after:content-[','] last:after:content-[''] transition"
                                       variant="subtle"
                                       external>
                                {{ $artist->name }}
                            </flux:link>
                        @endforeach
                    </div>

                    <p class="text-sm text-gray-500">{{ $release->release_date->diffForHumans() }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="space-y-4">
        <flux:heading size="xl" level="2">All Releases</flux:heading>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-8">
            @foreach($releases as $release)
                <div class="space-y-2">
                    <img src="{{ $release->media->first()->url}}"
                         alt="{{ $release->name }}"
                         class="w-full h-auto object-cover rounded-lg"
                    >

                    <div class="flex-grow flex flex-col gap-1">
                        <flux:link :href="$release->href" variant="ghost" external>
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
    </div>
</div>
