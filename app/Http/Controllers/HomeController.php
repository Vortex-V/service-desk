<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Ticket\Ticket;
use Illuminate\Contracts\Support\Renderable;

final class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $user = auth()->user();

        $ticketsQuery = Ticket::with(['applicant', 'applicant.contact', 'manager', 'manager.contact', 'type', 'priority']);

        if ($user->isAdmin()) {
            $ticketsPaginator = $ticketsQuery->cursorPaginate(10);
        } else {
            $ticketsPaginator = $ticketsQuery->whereAny(['author_id', 'applicant_id'], $user->id)->cursorPaginate(10);
        }

        return view('home', compact('ticketsPaginator'));
    }
}
