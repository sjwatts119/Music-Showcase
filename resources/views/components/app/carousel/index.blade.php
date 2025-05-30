@props([
    'config' => [
        'type' => 'carousel',
        'perView' => 1,
        'gap' => 24,
        'autoplay' => 7500,
        'hoverpause' => true,
        'peek' => 48,
        'breakpoints' => [
            '640' => [
                'perView' => 1,
                'peek' => 0,
            ],
        ],
    ],
])

@vite(['resources/js/glide.js'])

<div {{ $attributes->merge(['class' => 'glide flex flex-col gap-4']) }} data-glide="{{ collect($config)->toJson() }}" wire:ignore>
    <div class="glide__track sm:rounded-lg h-full" data-glide-el="track">
        <ul class="glide__slides h-full">
            {{ $slot }}
        </ul>
    </div>

    @if (isset($controls))
        {{ $controls }}
    @endif
</div>
