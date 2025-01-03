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
        Schema::create('comment_mentions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comment_id')
                ->constrained('comments');
            $table->unsignedBigInteger('user_id')
                ->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_mentions');
    }
};
