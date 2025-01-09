<?php

namespace App\Enums;

enum ProjectUserRole: string
{
    case ADVISOR = 'advisor';
    case MEMBER = 'member';

    public function getLabel(): string
    {
        return match($this) {
            self::ADVISOR => 'Orientador',
            self::MEMBER => 'Membro',
        };
    }
}
