<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // Angel, VC, Corporate, etc.
            $table->decimal('total_investment', 15, 2)->default(0);
            $table->integer('number_of_investments')->default(0);
            $table->string('location');
            $table->text('investment_focus');
            $table->string('website')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investors');
    }
}; 