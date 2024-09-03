<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->string('title_pl')->after('title')->nullable();
            $table->string('tagline')->after('title_pl')->nullable();
            $table->string('tagline_pl')->after('tagline')->nullable();
            $table->text('overview_pl')->after('overview')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn('title_pl');
            $table->dropColumn('tagline');
            $table->dropColumn('tagline_pl');
            $table->dropColumn('overview_pl');
        });
    }
};
