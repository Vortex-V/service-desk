<?php

namespace App\Enum;

enum UserRole: string
{
    case Admin = 'admin';
    case Manager = 'manager';
    case Client = 'client';
}
