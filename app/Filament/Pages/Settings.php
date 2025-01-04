<?php

namespace App\Filament\Pages;

use App\Settings\AppSettings;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class Settings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = AppSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        TextInput::make('spotify_artist_id')
                            ->label('Featured Artist ID')
                            ->required(),
                        Repeater::make('spotify_album_ids')
                            ->label('Featured albums')
                            ->addActionLabel('Add Album')
                            ->schema([
                                TextInput::make('id')
                                    ->label('Album ID')
                                    ->required(),
                            ]),
                    ])
            ]);
    }
}
