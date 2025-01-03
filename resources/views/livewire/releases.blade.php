<div class="max-w-screen-lg m-auto">
    <div class="flex flex-col gap-8 divide-solid mt-8">
        @foreach($releases['items'] as $release)
            <div class="flex gap-4">
                <div class="flex-shrink-0">
                    <img src="{{ $release['images'][0]['url'] }}" alt="{{ $release['name'] }}" class="w-24 h-24 rounded-lg">
                </div>
                <div>
                    <h2 class="text-lg font-semibold dark:text-gray-200">{{ $release['name'] }}</h2>
                    <p class="text-sm text-gray-500">{{ $release['release_date'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

</div>
