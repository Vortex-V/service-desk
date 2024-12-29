<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\StoreTicketPriorityRequest;
use App\Http\Requests\Admin\Ticket\UpdateTicketPriorityRequest;
use App\Models\Ticket\TicketPriority;

final class TicketPriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketPriorityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TicketPriority $ticketPriority)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TicketPriority $ticketPriority)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketPriorityRequest $request, TicketPriority $ticketPriority)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketPriority $ticketPriority)
    {
        //
    }
}
