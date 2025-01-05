<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Ticket\Enum\TicketStatus;
use App\Models\Ticket\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

final class TicketStatusController extends Controller
{
    public function toWork(Ticket $ticket): RedirectResponse
    {
        Gate::authorize('status-to-work', $ticket);
        $ticket->status = TicketStatus::InWork;
        $user = auth()->user();
        if ($user->can('is-manager', $ticket)) {
            $ticket->manager_id = $user->id;
        }
        $ticket->save();

        return redirect()->back();
    }

    public function reject(Ticket $ticket): RedirectResponse
    {
        Gate::authorize('status-to-rejected', $ticket);
        $ticket->status = TicketStatus::Rejected;
        $ticket->save();

        return redirect()->back();
    }

    public function close(Ticket $ticket): RedirectResponse
    {
        Gate::authorize('status-to-closed', $ticket);
        $ticket->status = TicketStatus::Closed;
        $ticket->save();

        return redirect()->back();
    }
}
