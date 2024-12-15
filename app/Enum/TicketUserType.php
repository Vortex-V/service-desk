<?php

namespace App\Enum;

enum TicketUserType: string
{
    case Applicant = 'applicant';
    case Author = 'author';
    case Manager = 'manager';
    case Watcher = 'watcher';
}
