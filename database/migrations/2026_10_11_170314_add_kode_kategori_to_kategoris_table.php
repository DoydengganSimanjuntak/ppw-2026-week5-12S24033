<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kategoris', function (Blueprint $table) {
            $table->string('kode_kategori')->nullable()->unique();
        });
    }

    public function down(): void
    {
        Schema::table('kategoris', function (Blueprint $table) {
            $table->dropUnique(['kode_kategori']);
            $table->dropColumn('kode_kategori');
        });
    }
};