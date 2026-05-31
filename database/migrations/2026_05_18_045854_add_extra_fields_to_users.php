<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'nationality')) {
                $table->string('nationality')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->string('address')->nullable()->after('nationality');
            }
            if (!Schema::hasColumn('users', 'field_of_specialty')) {
                $table->string('field_of_specialty')->nullable()->after('address');
            }
            if (!Schema::hasColumn('users', 'education_level')) {
                $table->string('education_level')->nullable()->after('field_of_specialty');
            }
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