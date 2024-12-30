<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\UpdateTicketRequest;
use App\Http\Requests\Ticket\StoreTicketRequest;
use App\Models\Ticket\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
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
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        Ticket::factory()->createOne($request->input());

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
