<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Project extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'client_id',
        'client_name',
        'name',
        'description',
        'status',
        'start_date',
        'deadline',
        'progress',
        'hours',
    ];

    /**
     * Attribute casting.
     */
    protected $casts = [
        'start_date' => 'datetime',
        'deadline' => 'datetime',
        'progress' => 'integer',
        'hours' => 'integer',
    ];

    /* =====================================================
     | RELATIONSHIPS
     |=====================================================*/

    /**
     * The client who owns this project.
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * The tasks associated with this project.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    /**
     * Feedback provided for this project.
     */
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'project_id');
    }

    /* =====================================================
     | ACCESSORS & HELPERS
     |=====================================================*/

    /**
     * Automatically ensure progress is between 0–100.
     */
    public function setProgressAttribute($value)
    {
        $this->attributes['progress'] = max(0, min(100, (int) $value));
    }

    /**
     * Check if the project is completed.
     */
    public function getIsCompletedAttribute(): bool
    {
        return $this->status === 'completed' || $this->progress >= 100;
    }

    /**
     * Remaining days until deadline (if applicable).
     */
    public function getDaysRemainingAttribute(): ?int
    {
        if ($this->deadline) {
            return now()->diffInDays(Carbon::parse($this->deadline), false);
        }
        return null;
    }
}
