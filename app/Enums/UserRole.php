<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMINISTRATOR = 'admin';
    case SUBSCRIBER = 'subscriber';

    public function getLabel(): string
    {
        return match($this) {
            self::ADMINISTRATOR => 'Administrador',
            self::SUBSCRIBER => 'Inscrito',
        };
    }
}
