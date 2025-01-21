<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Department;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DepartmentPolicy
{
    public function viewAny(User $user): bool
    {
        return true; // Todos podem ver departamentos
    }

    public function view(User $user, Department $department): bool
    {
        return true; // Todos podem ver departamentos específicos
    }

    public function create(User $user): bool
    {
        return $user->role === UserRole::ADMINISTRATOR;
    }

    public function update(User $user, Department $department): bool
    {
        return $user->role === UserRole::ADMINISTRATOR;
    }

    public function delete(User $user, Department $department): bool
    {
        return $user->role === UserRole::ADMINISTRATOR;
    }

    public function restore(User $user, Department $department): bool
    {
        return $user->role === UserRole::ADMINISTRATOR;
    }

    public function forceDelete(User $user, Department $department): bool
    {
        return $user->role === UserRole::ADMINISTRATOR;
    }
}
