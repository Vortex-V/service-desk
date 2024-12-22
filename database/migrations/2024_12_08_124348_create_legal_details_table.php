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
        Schema::create('legal_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
                ->constrained('clients', 'id');
            $table->string('inn');
            $table->string('kpp');
            $table->string('ogrn')->nullable();
            $table->string('bik')->nullable();
            $table->string('country');
            $table->string('city');
            $table->string('street');
            $table->string('house');
            $table->string('postcode')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_details');
    }
};
