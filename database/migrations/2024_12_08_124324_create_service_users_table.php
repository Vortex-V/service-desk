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
        Schema::create('service_users', function (Blueprint $table) {
            $table->comment('Таблица ответственных за определённые услуги');

            $table->id();
            $table->unsignedBigInteger('service_id')->index();
            $table->unsignedBigInteger('user_id')->index();

            $table->foreign('service_id')
                ->references('id')
                ->on('services');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
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
