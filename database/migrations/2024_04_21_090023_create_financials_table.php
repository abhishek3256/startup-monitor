<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('startup_id')->constrained()->onDelete('cascade');
            $table->foreignId('investor_id')->constrained()->onDelete('cascade');
            $table->decimal('investment_amount', 15, 2);
            $table->decimal('equity_offered', 5, 2); // Percentage of equity
            $table->decimal('valuation', 15, 2);
            $table->date('investment_date');
            $table->string('round'); // Seed, Series A, B, etc.
            $table->text('terms')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financials');
    }
}; 