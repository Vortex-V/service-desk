<?php

namespace App\View\Composers\Ticket;

use App\Models\Client\Client;
use App\Models\Ticket\Enum\TicketStatus;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketPriority;
use App\Models\Ticket\TicketSearch;
use App\Models\Ticket\TicketType;
use App\Models\User\Enum\UserRole;
use Illuminate\View\View;

class IndexViewComposer
{
    public function compose(View $view): void
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $ticketsPaginator = Ticket::with([
                'applicant', 'applicant.contact', 'manager', 'manager.contact', 'client', 'type', 'priority'
            ])->cursorPaginate(10);
        } else {
            $ticketsPaginator = app(TicketSearch::class)->search();
        }

        $ticketTypes = TicketType::all()->mapWithKeys(function (TicketType $ticketType, int $key) {
            return [$ticketType->id => $ticketType->title];
        })->toArray();
        $ticketPriorities = TicketPriority::all()->mapWithKeys(function (TicketPriority $ticketPriority, int $key) {
            return [$ticketPriority->id => $ticketPriority->title];
        })->toArray();
        $ticketStatuses = TicketStatus::labels();
        $clients = (match ($user->role) {
            UserRole::Client => $user->client()->get(),
            UserRole::Manager => Client::whereRelation('services.users', 'id', $user->id)->get(),
        })->mapWithKeys(function (Client $client, int $key) {
            return [$client->id => $client->name];
        })->toArray();

         $view
             ->with(compact(
                 'ticketsPaginator', 'ticketTypes', 'ticketPriorities', 'ticketStatuses', 'clients'
             ));

         session()?->flashInput(request()->input());
    }
}
