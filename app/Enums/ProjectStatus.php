<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case IN_PROGRESS = 'in_progress';
    case FINISHED = 'finished';

    public function getLabel(): string
    {
        return match($this) {
            self::IN_PROGRESS => 'Em Andamento',
            self::FINISHED => 'Finalizado',
        };
    }
}
