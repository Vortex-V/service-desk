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
        Schema::create('client_services', function (Blueprint $table) {
            $table->foreignId('client_id')
                ->constrained('clients', 'id');
            $table->foreignId('service_id')
                ->constrained('services', 'id');

            $table->primary(['client_id', 'service_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_services');
    }
};
