<?php

namespace App\Models\Ticket\Enum;

enum TicketUserType: string
{
    case Applicant = 'applicant';
    case Author = 'author';
    case Manager = 'manager';
    case Watcher = 'watcher';
}
