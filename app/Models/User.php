<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

/**
 * Mithila Tech IT Company Management System
 * Updated: October 12, 2025
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'bio',
        'profile_picture',
        'status',
        'last_login_at',
        'settings',
        'otp',
        'otp_expires_at',
        'email_verified_at',
    ];

    /**
     * Hidden attributes.
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp',
    ];

    /**
     * Attribute casting.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expires_at' => 'datetime',
        'password' => 'hashed',
        'join_date' => 'date',
        'settings' => 'array',
        'last_login_at' => 'datetime',
    ];

    /* =====================================================
     | RELATIONSHIPS
     |=====================================================*/

    /** ✅ For employees */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function attendance()
{
    return $this->hasMany(\App\Models\Attendance::class);
}

public function getAttendanceTodayAttribute()
{
    return $this->attendance()->where('date', now()->toDateString())->first();
}


    /** ✅ For clients */
    public function projects(): HasMany
    {
        // clients own projects via client_id in projects table
        return $this->hasMany(Project::class, 'client_id');
    }

    /** ✅ For admin or company-owned projects */
    public function ownedProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'owner_id');
    }

    public function leaves(): HasMany
    {
        return $this->hasMany(Leave::class);
    }

    public function performance(): HasMany
    {
        return $this->hasMany(Performance::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class, 'user_id');
    }

    /* =====================================================
     | SCOPES
     |=====================================================*/

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeVerified($query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    /* =====================================================
     | HELPERS & CHECKERS
     |=====================================================*/

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isEmployee(): bool
    {
        return $this->role === 'employee';
    }

    public function isClient(): bool
    {
        return $this->role === 'client';
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Used for signed email verification URLs.
     */
    public function getEmailForVerification(): string
    {
        return $this->email;
    }

    /**
     * Activate user (after verification).
     */
    public function activate(): void
    {
        $this->update([
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
    }

    /**
     * Deactivate user (utility).
     */
    public function deactivate(): void
    {
        $this->update(['status' => 'inactive']);
    }
}
