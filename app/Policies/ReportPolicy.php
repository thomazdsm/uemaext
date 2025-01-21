<?php

namespace App\Policies;

use App\Enums\ProjectUserRole;
use App\Enums\UserRole;
use App\Models\Report;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReportPolicy
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

    public function view(User $user, Report $report): bool
    {
        if ($user->role === UserRole::ADMINISTRATOR) {
            return true;
        }

        return $user->projectAssignments()
            ->where('project_id', $report->project_id)
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

    public function update(User $user, Report $report): bool
    {
        if ($user->role === UserRole::ADMINISTRATOR) {
            return true;
        }

        return $user->projectAssignments()
            ->where('project_id', $report->project_id)
            ->where('role', ProjectUserRole::ADVISOR->value)
            ->exists();
    }

    public function delete(User $user, Report $report): bool
    {
        return $user->role === UserRole::ADMINISTRATOR;
    }

    public function restore(User $user, Report $report): bool
    {
        return $user->role === UserRole::ADMINISTRATOR;
    }

    public function forceDelete(User $user, Report $report): bool
    {
        return $user->role === UserRole::ADMINISTRATOR;
    }
}
