<?php

namespace App\Policies;

use App\Enums\ProjectUserRole;
use App\Enums\UserRole;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Admins podem ver todos os projetos
        if ($user->role === UserRole::ADMINISTRATOR) {
            return true;
        }

        // Orientadores podem ver os projetos aos quais estão vinculados
        return $user->projectAssignments()
            ->where('role', ProjectUserRole::ADVISOR->value)
            ->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
        // Admins podem ver qualquer projeto
        if ($user->role === UserRole::ADMINISTRATOR) {
            return true;
        }

        // Orientadores podem ver seus projetos
        return $user->projectAssignments()
            ->where('project_id', $project->id)
            ->where('role', ProjectUserRole::ADVISOR->value)
            ->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Somente admins podem criar projetos
        return $user->role === UserRole::ADMINISTRATOR;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $project): bool
    {
        // Admins podem atualizar qualquer projeto
        if ($user->role === UserRole::ADMINISTRATOR) {
            return true;
        }

        // Orientadores podem atualizar seus projetos
        return $user->projectAssignments()
            ->where('project_id', $project->id)
            ->where('role', ProjectUserRole::ADVISOR->value)
            ->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $project): bool
    {
        // Somente admins podem deletar projetos
        return $user->role === UserRole::ADMINISTRATOR;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Project $project): bool
    {
        // Somente admins podem restaurar projetos
        return $user->role === UserRole::ADMINISTRATOR;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $project): bool
    {
        // Somente admins podem deletar permanentemente projetos
        return $user->role === UserRole::ADMINISTRATOR;
    }
}
