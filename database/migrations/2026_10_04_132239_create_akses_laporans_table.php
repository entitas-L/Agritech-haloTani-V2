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
        Schema::create('akses_laporan', function (Blueprint $table) {
            $table->increments('id_akses');
            $table->string('id_petani', 50);
            $table->string('id_laporan', 50);
            $table->timestamp('waktu_akses')->nullable()->useCurrent();

            $table->foreign('id_petani')
                ->references('id_petani')->on('petani')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('id_laporan')
                ->references('id_laporan')->on('laporan')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akses_laporan');
    }
};
