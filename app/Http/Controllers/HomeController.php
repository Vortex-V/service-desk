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

        if ($user->isAdmin()) {
            $ticketsPaginator = Ticket::cursorPaginate(10);
        } else {
            $ticketsPaginator = Ticket::whereAny(['author_id', 'applicant_id'], $user->id)->cursorPaginate(10);
        }

        return view('home', compact('ticketsPaginator'));
    }
}
