<?php

declare(strict_types=1);

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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')
                ->constrained('ticket_types', 'id');
            $table->foreignId('priority_id')
                ->constrained('ticket_priorities', 'id');
            $table->string('description');
            $table->string('status');
            $table->foreignId('applicant_id')
                ->constrained('users', 'id');
            $table->foreignId('author_id')
                ->constrained('users', 'id');
            $table->foreignId('manager_id')
                ->nullable()
                ->constrained('users', 'id');
            $table->foreignId('client_id')
                ->constrained('clients', 'id');
            $table->foreignId('service_id')
                ->constrained('services', 'id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
