<?php

declare(strict_types=1);

namespace App\Models\Ticket;

use App\Models\Client\Client;
use App\Models\Ticket\Enum\TicketStatus;
use App\Models\User\User;
use Database\Factories\TicketFactory;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

final class Ticket extends Model
{
    /** @use HasFactory<TicketFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'tickets';
    protected static string $factory = TicketFactory::class;

    protected $fillable = [
        'applicant_id',
        'service_id',
        'type_id',
        'priority_id',
        'description',
    ];

    public function casts(): array
    {
        return [
            'status' => TicketStatus::class,
        ];
    }

    //region Relations
    public function type(): HasOne
    {
        return $this->hasOne(TicketType::class, 'id', 'type_id');
    }

    public function priority(): HasOne
    {
        return $this->hasOne(TicketPriority::class, 'id', 'priority_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'ticket_user', 'ticket_id', 'user_id');
    }

    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function applicant(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'applicant_id');
    }

    public function manager(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'manager_id');
    }

    public function client(): HasOne
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
    //endregion

    public static function getStatusLabel(self $ticket): string
    {
        return TicketStatus::label($ticket->status);
    }
}
