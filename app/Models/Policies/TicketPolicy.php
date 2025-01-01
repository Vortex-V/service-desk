<?php

 declare(strict_types=1);

namespace App\Models\Policies;

use App\Models\Ticket\Ticket;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class TicketPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Ticket $ticket): bool
    {
        return $this->isAuthor($user, $ticket);
    }

    public function delete(User $user, Ticket $ticket): bool
    {
        return $this->isAuthor($user, $ticket);
    }

    public function isAuthor(User $user, Ticket $ticket): bool
    {
        return $user->id === $ticket->author_id;
    }
}
