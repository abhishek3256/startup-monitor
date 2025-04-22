<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('startups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('founder_name');
            $table->text('description');
            $table->string('industry');
            $table->string('stage');
            $table->decimal('total_funding', 15, 2)->default(0);
            $table->integer('employee_count')->default(0);
            $table->string('location');
            $table->date('founded_date');
            $table->string('website')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('startups');
    }
}; 