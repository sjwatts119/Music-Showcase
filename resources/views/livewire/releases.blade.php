<div class="max-w-screen-lg m-auto">
    <div class="flex flex-col gap-8 divide-solid mt-8">
        @foreach($releases->items as $release)
            <div class="flex gap-4">
                <div class="flex-shrink">
                    <img
                        src="{{ $release->images->first()->url }}"
                        alt="{{ $release->name }}"
                        class="w-24 h-24 rounded-lg"
                    >
                </div>
                <div class="flex-grow">
                    <h2 class="text-lg font-semibold dark:text-gray-200">{{ $release->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $release->releaseDate->format('Y-m-d') }}</p>
                    {{--                    <iframe style="border-radius:12px"--}}
                    {{--                            src="https://open.spotify.com/embed/album/{{ $release->id }}"--}}
                    {{--                            width="100%"--}}
                    {{--                            height="352"--}}
                    {{--                            frameBorder="0"--}}
                    {{--                            allowfullscreen=""--}}
                    {{--                            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"--}}
                    {{--                            loading="lazy">--}}
                    {{--                    </iframe>--}}
                </div>
            </div>
        @endforeach
    </div>
</div>
