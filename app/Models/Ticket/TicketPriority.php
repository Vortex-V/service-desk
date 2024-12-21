<?php

namespace App\Models\Ticket;

use Database\Factories\TicketPriorityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketPriority extends Model
{
    /** @use HasFactory<TicketPriorityFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'ticket_priorities';

    protected $fillable = [
        'title',
    ];
}
