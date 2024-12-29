<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TicketPriorityController;
use App\Http\Controllers\Admin\TicketTypeController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resources([
    'users' => UserController::class,
    'users.contacts' => ContactController::class,
    'clients' => ClientController::class,
    'services' => ServiceController::class,
    'ticket-priorities' => TicketPriorityController::class,
    'ticket-types' => TicketTypeController::class,
]);
