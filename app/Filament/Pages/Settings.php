<?php

namespace App\Filament\Pages;

use App\Jobs\UpdatePlaylists;
use App\Jobs\UpdateReleases;
use App\Settings\AppSettings;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class Settings extends SettingsPage
{
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = AppSettings::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
       $data['spotify_artist_id'] = trim($data['spotify_artist_id']);

       $data['spotify_playlist_ids'] = collect($data['spotify_playlist_ids'])
           ->map(fn($playlist) => [
               'id' => trim($playlist['id']),
           ])
           ->toArray();

       return $data;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Split::make([
                    Forms\Components\Section::make()
                        ->key('settings')
                        ->schema([
                            TextInput::make('spotify_artist_id')
                                ->label('Featured Artist ID')
                                ->required(),
                        ])
                        ->headerActions([
                            Forms\Components\Actions\Action::make('refresh-releases')
                                ->label('Refresh Releases')
                                ->requiresConfirmation()
                                ->action(fn() => UpdateReleases::dispatch()),
                        ]),

                    Forms\Components\Section::make()
                        ->key('playlist')
                        ->schema([
                            Repeater::make('spotify_playlist_ids')
                                ->label('Featured Playlists')
                                ->addActionLabel('Add Playlist')
                                ->schema([
                                    TextInput::make('id')
                                        ->label('Playlist ID')
                                        ->required(),
                                ]),
                        ])
                        ->headerActions([
                            Forms\Components\Actions\Action::make('refresh-playlists')
                                ->label('Refresh Playlists')
                                ->requiresConfirmation()
                                ->action(fn() => UpdatePlaylists::dispatch()),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
