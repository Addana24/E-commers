<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser; // Tambahkan ini
use Filament\Panel; // Tambahkan ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser // Tambahkan implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Mengizinkan user untuk mengakses panel Filament.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Untuk saat ini, izinkan semua user yang terdaftar untuk login.
        // Kamu bisa memperketat ini nanti, misal: return str_ends_with($this->email, '@gmail.com');
        return true; 
    }
}