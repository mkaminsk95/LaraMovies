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
        Schema::table('movies', function (Blueprint $table) {
            $table->unsignedInteger('tmdb_id')->nullable()->change();
            $table->string('vote_average')->nullable()->change();
            $table->string('vote_count')->nullable()->change();
            $table->string('poster_path')->nullable()->change();
            $table->string('backdrop_path')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->unsignedInteger('tmdb_id')->change();
            $table->string('vote_average')->change();
            $table->string('vote_count')->change();
            $table->string('poster_path')->change();
            $table->string('backdrop_path')->change();
        });
    }
};
