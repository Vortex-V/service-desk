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
        Schema::create('service_users', function (Blueprint $table) {
            $table->comment('Таблица ответственных за определённые услуги');

            $table->foreignId('service_id')
                ->constrained('services', 'id');
            $table->foreignId('user_id')
                ->constrained('users', 'id');

            $table->primary(['service_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_users');
    }
};
