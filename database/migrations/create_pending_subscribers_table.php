<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pending_subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->json('data')->nullable();
            $table->json('options')->nullable();
            $table->string('token')->unique();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pending_subscribers');
    }
};
