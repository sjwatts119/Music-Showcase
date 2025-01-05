<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxStyles
    </head>
    <body class="font-sans antialiased bg-zinc-100 dark:bg-zinc-900">
        <div class="min-h-screen">
            <livewire:layout.navigation />

            <main class="max-w-screen-lg m-auto px-4 py-8 md:px-8">
                {{ $slot }}
            </main>
        </div>

        <x-footer />
        @fluxScripts
    </body>
</html>
