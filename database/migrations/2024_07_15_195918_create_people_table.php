<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->integer('tmdb_id')->unique();
            $table->string('name');
            $table->integer('gender')->nullable();
            $table->text('biography')->nullable();
            $table->date('birthday')->nullable();
            $table->date('deathday')->nullable();
            $table->integer('popularity')->default(0);
            $table->string('profile_path')->nullable();
        });

        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->foreignId('person_id')->constrained()->onDelete('cascade');
            $table->longText('character')->nullable();
            $table->integer('order')->nullable();
            $table->string('department');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credits');
        Schema::dropIfExists('people');
    }
};
