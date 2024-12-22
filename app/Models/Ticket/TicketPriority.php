<?php

declare(strict_types=1);

namespace App\Models\Ticket;

use Database\Factories\TicketPriorityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class TicketPriority extends Model
{
    /** @use HasFactory<TicketPriorityFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'ticket_priorities';
    protected static string $factory = TicketPriorityFactory::class;

    protected $fillable = [
        'title',
    ];
}
