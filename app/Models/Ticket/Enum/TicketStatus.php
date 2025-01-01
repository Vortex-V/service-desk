<?php

namespace App\Models\Ticket\Enum;

enum TicketStatus: string
{
    case Draft = 'draft';
    case New = 'new';
    case InWork = 'in_work';
    case Closed = 'closed';
    case Rejected = 'rejected';
}
