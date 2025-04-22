<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('milestones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('startup_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->date('target_date');
            $table->date('achieved_date')->nullable();
            $table->string('status')->default('pending'); // pending, achieved, delayed
            $table->string('category'); // funding, product, team, etc.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('milestones');
    }
}; 