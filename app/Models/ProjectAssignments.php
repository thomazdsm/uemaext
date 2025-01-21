<?php

namespace App\Models;

use App\Enums\ProjectUserRole;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use function Laravel\Prompts\error;

class ProjectAssignments extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'project_assignments';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>ca
     */
    protected $fillable = [
        'project_id',
        'user_id',
        'role',
    ];

    /**
     * Get the associated project.
     */
    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the associated user.
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor for role to return the enum.
     */
    public function getRoleAttribute($value): ProjectUserRole
    {
        return ProjectUserRole::from($value);
    }

    /**
     * Mutator for role to save as enum value.
     */
    public function setRoleAttribute($role): void
    {
        if (is_string($role)) {
            $this->attributes['role'] = $role;
        } elseif ($role instanceof ProjectUserRole) {
            $this->attributes['role'] = $role->value;
        } else {
            throw Exception('Role must be string or ProjectUserRole');
        }
    }
}
