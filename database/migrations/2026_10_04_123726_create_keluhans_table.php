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
        Schema::create('keluhan', function (Blueprint $table) {
            $table->string('id_keluhan', 10)->primary();
            $table->string('id_petani', 50);
            $table->text('teks_keluhan');
            $table->date('tanggal');
            $table->string('status', 20)->nullable()->default('pending');
            

            $table->foreign('id_petani')->references('id_petani')->on('petani')->cascadeOnUpdate()->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluhan');
    }
};
