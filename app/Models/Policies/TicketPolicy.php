<?php

 declare(strict_types=1);

namespace App\Models\Policies;

use App\Models\Ticket\Enum\TicketStatus;
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

    public function isManager(User $user, Ticket $ticket): bool
    {
        return $ticket->manager_id === $user->id || $user->isManager();
    }

    private function canMoveStatusTo(Ticket $ticket, TicketStatus $newStatus): bool
    {
        return in_array($newStatus, TicketStatus::statusMap()[$ticket->status->name], true);
    }

    public function statusToWork(User $user, Ticket $ticket): bool
    {
        return $this->isManager($user, $ticket)
            && $this->canMoveStatusTo($ticket, TicketStatus::InWork);
    }

    public function statusToClosed(User $user, Ticket $ticket): bool
    {
        return $this->isManager($user, $ticket)
            && $this->canMoveStatusTo($ticket, TicketStatus::Closed);
    }

    public function statusToRejected(User $user, Ticket $ticket): bool
    {
        return $this->isManager($user, $ticket)
            && $this->canMoveStatusTo($ticket, TicketStatus::Rejected);
    }
}
