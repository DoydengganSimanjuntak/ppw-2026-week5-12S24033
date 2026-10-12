<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->string('isbn')->nullable()->unique();
            $table->text('sinopsis')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->dropUnique(['isbn']);
            $table->dropColumn(['isbn', 'sinopsis']);
        });
    }
};