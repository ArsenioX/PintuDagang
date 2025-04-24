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
        Schema::table('carts', function (Blueprint $table) {
            $table->string('nama')->nullable()->change(); // Membuat kolom nullable
        });
    }

    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->string('nama')->nullable(false)->change(); // Kembali ke keadaan semula
        });
    }
};
