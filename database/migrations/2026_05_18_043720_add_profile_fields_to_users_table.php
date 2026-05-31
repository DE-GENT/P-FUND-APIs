<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('nationality')->nullable()->after('phone');
            $table->string('address')->nullable()->after('nationality');
            $table->string('field_of_specialty')->nullable()->after('address');
            $table->string('education_level')->nullable()->after('field_of_specialty');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'nationality',
                'address',
                'field_of_specialty',
                'education_level',
            ]);
        });
    }
};