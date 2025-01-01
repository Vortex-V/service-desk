<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\UpdateTicketRequest;
use App\Http\Requests\Ticket\StoreTicketRequest;
use App\Models\Client\Client;
use App\Models\Service\Service;
use App\Models\Ticket\Ticket;
use App\Models\User\Enum\UserRole;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

final class TicketController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        $clients = match ($user->role) {
            UserRole::Client => $user->client()->get(),
            UserRole::Manager => Client::whereRelation('services.users', 'id', $user->id)->get(),
        };

        $services = Service::whereHas('clients', function (Builder $query) use ($clients) {
            $query->whereIn('id', $clients->pluck('id'));
        })
            ->with('clients')
            ->get()
            ->map(function (Service $service) {
                return [
                    'id' => $service->id,
                    'title' => $service->title,
                    'clientIds' => $service->clients->pluck('id'),
                ];
            });

        $usersByClientId = User::whereIn('client_id', $clients->pluck('id'))->get()->groupBy('client_id');

        return view('ticket.create', compact('clients', 'services', 'usersByClientId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::factory()->makeOne();
        $ticket->fill($request->validated());
        $ticket->client_id = User::where('id', $request->applicant_id)->value('client_id');
        $user = auth()->user();
        if ($user->isManager()) {
            $ticket->manager_id = $user->id;
        } 
        $ticket->save();

        return redirect('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        Gate::allows('delete', $ticket);

        $ticket->delete();

        return redirect('home');
    }
}
