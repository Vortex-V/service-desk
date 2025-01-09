<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TicketPriorityController;
use App\Http\Controllers\Admin\TicketTypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketStatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('tickets', TicketController::class)
        ->only(['index', 'create', 'store', 'show']);
    Route::post('tickets/{ticket}/to-work', [TicketStatusController::class, 'toWork'])->name('tickets.to-work');
    Route::post('tickets/{ticket}/close', [TicketStatusController::class, 'close'])->name('tickets.close');
    Route::post('tickets/{ticket}/reject', [TicketStatusController::class, 'reject'])->name('tickets.reject');

    Route::resource('tickets.comments', CommentController::class)
        ->only(['store', 'update']);

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
