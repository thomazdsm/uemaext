<?php

namespace App\Policies;

use App\Enums\ProjectUserRole;
use App\Enums\UserRole;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ActivityPolicy
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

    public function view(User $user, Activity $activity): bool
    {
        if ($user->role === UserRole::ADMINISTRATOR) {
            return true;
        }

        return $user->projectAssignments()
            ->where('project_id', $activity->project_id)
            ->where('role', ProjectUserRole::ADVISOR->value)
            ->exists();
    }

    public function create(User $user): bool
    {
        if ($user->role === UserRole::ADMINISTRATOR) {
            return true;
        }

        return $user->projectAssignments()
            ->where('role', ProjectUserRole::ADVISOR->value)
            ->exists();
    }

    public function update(User $user, Activity $activity): bool
    {
        if ($user->role === UserRole::ADMINISTRATOR) {
            return true;
        }

        return $user->projectAssignments()
            ->where('project_id', $activity->project_id)
            ->where('role', ProjectUserRole::ADVISOR->value)
            ->exists();
    }

    public function delete(User $user, Activity $activity): bool
    {
        return $user->role === UserRole::ADMINISTRATOR;
    }

    public function restore(User $user, Activity $activity): bool
    {
        return $user->role === UserRole::ADMINISTRATOR;
    }

    public function forceDelete(User $user, Activity $activity): bool
    {
        return $user->role === UserRole::ADMINISTRATOR;
    }
}
