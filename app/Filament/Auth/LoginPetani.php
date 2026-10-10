<?php

namespace App\Filament\Auth;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SimplePage;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class LoginPetani extends SimplePage implements HasForms
{
    use InteractsWithForms;

    // HANYA ini yang non-static
    protected string $view = 'filament.pages.auth.login-petani';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form($form)
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->autocomplete()
                    ->autofocus(),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required(),
                Checkbox::make('remember')
                    ->label('Remember me'),
            ])
            ->statePath('data');
    }

    public function authenticate()
    {
        $data = $this->form->getState();

        if (auth()->attempt(['email' => $data['email'], 'password' => $data['password']], $data['remember'] ?? false)) {
            session()->regenerate();
            return redirect()->intended('/petani');
        }

        $this->addError('data.email', 'Email atau password yang Anda masukkan salah.');
    }
}