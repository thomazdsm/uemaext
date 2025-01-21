<?php

namespace App\Policies;

use App\Enums\ProjectUserRole;
use App\Enums\UserRole;
use App\Models\ProjectAssignments;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectAssignmentsPolicy
{
    public function viewAny(User $user): bool
    {
        if ($user->role === UserRole::ADMINISTRATOR) {
            return true;
        }

        return $user->projectAssignments()
            ->where('role', ProjectUserRole::ADVISOR->value)
            ->exists();
    }

    public function view(User $user, ProjectAssignments $assignment): bool
    {
        if ($user->role === UserRole::ADMINISTRATOR) {
            return true;
        }

        return $user->projectAssignments()
            ->where('project_id', $assignment->project_id)
            ->where('role', ProjectUserRole::ADVISOR->value)
            ->exists();
    }

    public function create(User $user): bool
    {
        return $user->role === UserRole::ADMINISTRATOR;
    }

    public function update(User $user, ProjectAssignments $assignment): bool
    {
        return $user->role === UserRole::ADMINISTRATOR;
    }

    public function delete(User $user, ProjectAssignments $assignment): bool
    {
        return $user->role === UserRole::ADMINISTRATOR;
    }

    public function restore(User $user, ProjectAssignments $assignment): bool
    {
        return $user->role === UserRole::ADMINISTRATOR;
    }

    public function forceDelete(User $user, ProjectAssignments $assignment): bool
    {
        return $user->role === UserRole::ADMINISTRATOR;
    }
}
