<?php

namespace App\Filament\Pages;
use BackedEnum;

use Filament\Pages\Page;

class ProfilePetani extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Profile Saya';
    protected string $view = 'filament.pages.profile-petani';

    public function getTitle(): string
    {
        return 'Profile Petani';
    }
}