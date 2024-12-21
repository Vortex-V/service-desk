<?php

namespace App\Models\User\Enum;

enum UserRole: string
{
    case Admin = 'admin';
    case Manager = 'manager';
    case Client = 'client';
}
