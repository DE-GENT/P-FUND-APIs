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
        Schema::create('sponsor_project_interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('interaction_type'); // 'save', 'like', 'dislike', 'viewed'
            $table->timestamps();

            // A user can only have one type of specific interaction per project at a time (e.g. they can like OR dislike, but we'll manage this in logic. Uniqueness on user+project+type prevents duplicates of the exact same interaction)
            $table->unique(['user_id', 'project_id', 'interaction_type'], 'spi_user_proj_type_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsor_project_interactions');
    }
};
