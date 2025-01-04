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

<div>
    <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="home"
                              :href="route('site.index')"
                              :current="request()->routeIs('site.*')"
                              wire:navigate>
                Home
            </flux:navbar.item>
            <flux:navbar.item icon="musical-note"
                              :href="route('releases.index')"
                              :current="request()->routeIs('releases.*')"
                              wire:navigate>
                Releases
            </flux:navbar.item>
            <flux:navbar.item icon="play-circle"
                              :href="route('site.index')"
                              wire:navigate>
                Playlists
            </flux:navbar.item>
        </flux:navbar>

        <flux:spacer />

        <flux:navbar class="-mb-px">
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

    <flux:sidebar stashable sticky class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="home" href="{{ route('site.index') }}" :current="request()->routeIs('site.*')">Home</flux:navlist.item>
            <flux:navlist.item icon="musical-note" href="{{ route('releases.index') }}" :current="request()->routeIs('releases.*')">Releases</flux:navlist.item>
            <flux:navlist.item icon="play-circle" href="{{ route('site.index') }}">Playlists</flux:navlist.item>
        </flux:navlist>

        <flux:spacer />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item>
            <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>
        </flux:navlist>
    </flux:sidebar>
</div>

