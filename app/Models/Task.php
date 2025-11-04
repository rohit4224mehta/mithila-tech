<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'project_id',
        'user_id',
        'title',
        'description',
        'status',
        'due_date',
    ];

    /**
     * Attribute casting.
     */
    protected $casts = [
        'due_date' => 'date',
    ];

    /* =====================================================
     | RELATIONSHIPS
     |=====================================================*/

    /**
     * The project this task belongs to.
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    /**
     * The user assigned to this task (usually employee or client).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /* =====================================================
     | ACCESSORS & HELPERS
     |=====================================================*/

    /**
     * Check if the task is completed.
     */
    public function getIsCompletedAttribute(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Determine if task is overdue.
     */
    public function getIsOverdueAttribute(): bool
    {
        return $this->due_date && $this->status !== 'completed' && $this->due_date->isPast();
    }
}
