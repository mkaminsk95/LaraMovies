<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avatars', function (Blueprint $table) {
            $table->id();
            $table->string('path');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('avatar_id')->nullable()->constrained();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['avatar_id']);
            $table->dropColumn('avatar_id');
        });
        Schema::dropIfExists('avatars');
    }
};
