<?php

namespace App\Filament\Auth;

use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;

class RegisterPetani extends BaseRegister
{
    protected function getNameFormComponent(): Component
    {
        return TextInput::make('nama')
            ->label('Nama lengkap')
            ->required()
            ->maxLength(100)
            ->autofocus();
    }
}