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
        Schema::create('get_anggaran_belanja_sub_ket', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ket_sub_bl')->nullable()->index();
            $table->unsignedBigInteger('id_bl')->nullable()->index();
            $table->unsignedBigInteger('id_sub_bl')->nullable()->index();
            $table->unsignedInteger('tahun')->nullable()->index();
            $table->unsignedBigInteger('id_daerah')->nullable()->index();
            $table->unsignedBigInteger('id_unit')->nullable()->index();
            $table->unsignedBigInteger('id_skpd')->nullable()->index();
            $table->unsignedBigInteger('id_sub_skpd')->nullable()->index();
            $table->unsignedBigInteger('id_program')->nullable()->index();
            $table->unsignedBigInteger('id_giat')->nullable()->index();
            $table->unsignedBigInteger('id_sub_giat')->nullable()->index();
            $table->text('ket_bl_teks')->nullable();
            $table->text('nama_bl')->nullable();
            $table->text('nama_sub_bl')->nullable();
            $table->text('nama_daerah')->nullable();
            $table->text('nama_unit')->nullable();
            $table->text('nama_skpd')->nullable();
            $table->text('nama_sub_skpd')->nullable();
            $table->text('nama_program')->nullable();
            $table->text('nama_giat')->nullable();
            $table->text('nama_sub_giat')->nullable();
            $table->string('kode_daerah')->nullable();
            $table->string('kode_unit')->nullable();
            $table->string('kode_skpd')->nullable();
            $table->string('kode_sub_skpd')->nullable();
            $table->string('kode_program')->nullable();
            $table->string('kode_giat')->nullable();
            $table->string('kode_sub_giat')->nullable();
            $table->unsignedBigInteger('id_jadwal')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('get_anggaran_belanja_sub_ket');
    }
};
