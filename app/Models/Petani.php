<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Petani extends Authenticatable implements FilamentUser, HasName
{
    use HasUuids, Notifiable;

    const UPDATED_AT = null;

    protected $table = 'petani';
    protected $primaryKey = 'id_petani';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['nama', 'email', 'password', 'kontak', 'alamat'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Panel admin (nanti) hanya untuk role admin
        if ($panel->getId() === 'admin') {
            return $this->isAdmin();
        }

        return true;
    }

    public function getFilamentName(): string
    {
        return $this->nama;
    }

    public function keluhan(): HasMany
    {
        return $this->hasMany(Keluhan::class, 'id_petani', 'id_petani');
    }
}