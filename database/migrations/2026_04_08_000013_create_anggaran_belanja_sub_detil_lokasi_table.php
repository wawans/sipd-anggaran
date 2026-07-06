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
        Schema::create('anggaran_belanja_sub_detil_lokasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_detil_lokasi')->nullable()->index();
            $table->unsignedInteger('tahun')->nullable()->index();
            $table->unsignedBigInteger('id_daerah')->nullable()->index();
            $table->unsignedBigInteger('id_unit')->nullable()->index();
            $table->unsignedBigInteger('id_bl')->nullable()->index();
            $table->unsignedBigInteger('id_sub_bl')->nullable()->index();
            $table->unsignedBigInteger('id_kab_kota')->nullable()->index();
            $table->unsignedBigInteger('id_camat')->nullable()->index();
            $table->unsignedBigInteger('id_lurah')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggaran_belanja_sub_detil_lokasi');
    }
};
