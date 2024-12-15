<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ticket_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('type');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('ticket_id')
                ->references('id')
                ->on('tickets');

            $table->index(['ticket_id', 'type'], 'ticket_users_ticket_id_type_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_users');
    }
};
