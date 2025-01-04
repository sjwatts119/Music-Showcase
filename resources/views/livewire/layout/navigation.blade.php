<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
    <flux:navbar class="-mb-px max-lg:hidden">
        <flux:navbar.item icon="home" :href="route('site.index')" current>Home</flux:navbar.item>
        <flux:navbar.item icon="musical-note" :href="route('site.index')">Releases</flux:navbar.item>
        <flux:navbar.item icon="play-circle" :href="route('site.index')">Playlists</flux:navbar.item>
    </flux:navbar>

    <flux:spacer />

    <flux:navbar class="mr-4">
        <flux:navbar.item icon="magnifying-glass" href="#" label="Search" />
    </flux:navbar>

    @auth
        <flux:dropdown position="top" align="start">
            <flux:button variant="ghost" icon-trailing="chevron-down" label="Account">{{ auth()->user()->name }}</flux:button>

            <flux:menu>
                <flux:menu.item icon="user">Profile</flux:menu.item>
                <flux:menu.item icon="cog">Manage Site</flux:menu.item>

                <flux:menu.separator />

                <flux:menu.item wire:click="logout" icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    @endauth
</flux:header>
