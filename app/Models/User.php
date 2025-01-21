<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'department_id',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function department(): BelongsTo {
        return $this->belongsTo(Department::class);
    }

    /**
     * Accessor for role to return the enum.
     */
    public function getRoleAttribute($value): UserRole
    {
        return UserRole::from($value);
    }

    /**
     * Mutator for role to save as enum value.
     */
    public function setRoleAttribute($role): void
    {
        if (is_string($role)) {
            $this->attributes['role'] = $role;
        } elseif ($role instanceof UserRole) {
            $this->attributes['role'] = $role->value;
        } else {
            throw Exception('Role must be string or UserRole');
        }
    }

    public function projectAssignments()
    {
        return $this->hasMany(ProjectAssignments::class);
    }
}
