<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TicketPriorityController;
use App\Http\Controllers\Admin\TicketTypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('tickets', TicketController::class)
        ->only(['index', 'create', 'store', 'show']);

    Route::prefix('admin')
        ->middleware('can:admin')
        ->group(function () {
            Route::resources([
                'users' => UserController::class,
                'users.contacts' => ContactController::class,
                'clients' => ClientController::class,
                'services' => ServiceController::class,
                'ticket-priorities' => TicketPriorityController::class,
                'ticket-types' => TicketTypeController::class,
            ]);
        });
});
