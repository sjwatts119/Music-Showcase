<div class="max-w-screen-lg m-auto py-8 space-y-8">

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
        <div class="grid grid-cols-3 gap-8">
            @foreach($releases as $release)
                <a href="{{ $release->href }}">
                    <img src="{{ $release->media->first()->url}}"
                         alt="{{ $release->name }}"
                         class="w-full h-full object-cover rounded-lg"
                    >
                </a>
            @endforeach
        </div>
        {{ $releases->links() }}

    </div>

</div>
