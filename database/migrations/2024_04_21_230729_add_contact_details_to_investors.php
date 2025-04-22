<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('investors', function (Blueprint $table) {
            $table->string('email')->nullable()->after('website');
            $table->string('contact_person')->nullable()->after('email');
            $table->string('phone')->nullable()->after('contact_person');
            $table->string('investment_range')->nullable()->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('investors', function (Blueprint $table) {
            $table->dropColumn(['email', 'contact_person', 'phone', 'investment_range']);
        });
    }
};
