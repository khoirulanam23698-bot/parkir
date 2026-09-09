<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'profile_photo_path', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{

public function bookings()
{
    return $this->hasMany(Booking::class);
}
public function profilePhotoUrl(): string
{
    return $this->profile_photo_path
        ? asset('storage/' . $this->profile_photo_path)
        : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F56D9&background=EBE9FE';
}


public function isAdmin(): bool
{
    return $this->role === 'admin';
}

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed'
        ];
    }

    public function isPetugas(): bool
{
    return $this->role === 'petugas';
}

public function isOwner(): bool
{
    return $this->role === 'owner';
}

public function vehicles()
{
    return $this->hasMany(Vehicle::class);
}

}
