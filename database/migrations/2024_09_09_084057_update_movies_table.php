<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->integer('budget')->nullable();
            $table->integer('revenue')->nullable();
            $table->integer('runtime')->nullable();
            $table->string('status')->nullable();
            $table->boolean('adult')->nullable();
            $table->json('origin_country')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn('budget');
            $table->dropColumn('revenue');
            $table->dropColumn('runtime');
            $table->dropColumn('status');
            $table->dropColumn('adult');
            $table->dropColumn('origin_country');
        });
    }
};
