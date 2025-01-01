<?php

declare(strict_types=1);

namespace App\Models\Ticket;

use App\Models\User\User;
use Database\Factories\TicketFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Ticket extends Model
{
    /** @use HasFactory<TicketFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'tickets';
    protected static string $factory = TicketFactory::class;

    protected $fillable = [
        'manager_id',
        'applicant_id',
        'service_id',
        'type_id',
        'priority_id',
        'description',
    ];

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
    //endregion
}
