@props([
    'config' => [
        'type' => 'carousel',
        'perView' => 2,
        'gap' => 24,
        'autoplay' => 5000,
        'hoverpause' => true,
        'peek' => 60,
        'breakpoints' => [
            '1280' => [
                'perView' => 2,
                'peek' => 48,
            ],
            '1024' => [
                'perView' => 1,
                'peek' => 48,
            ],
            '768' => [
                'perView' => 1,
                'peek' => 0,
            ],
        ],
    ],
])

@vite(['resources/js/glide.js'])

<div {{ $attributes->merge(['class' => 'glide flex flex-col gap-4']) }} data-glide="{{ collect($config)->toJson() }}">
    <div class="glide__track sm:rounded-lg h-full" data-glide-el="track">
        <ul class="glide__slides h-full">
            {{ $slot }}
        </ul>
    </div>

    @if (isset($controls))
        {{ $controls }}
    @endif
</div>
