<?php

declare(strict_types=1);

namespace App\Models\Ticket;

use Database\Factories\TicketTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class TicketType extends Model
{
    /** @use HasFactory<TicketTypeFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'ticket_types';
    protected static string $factory = TicketTypeFactory::class;

    protected $fillable = [
        'title',
    ];
}
