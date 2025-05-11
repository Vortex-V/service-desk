<?php

namespace App\Models\User\Enum;

enum UserRole: string
{
    case Admin = 'admin';
    case Manager = 'manager';
    case Client = 'client';

    public static function labels(): array
    {
        return [
            self::Manager->value => 'Менеджер',
            self::Client->value => 'Клиент',
        ];
    }

    public static function label(self $value): string
    {
        return self::labels()[$value->value];
    }
}
