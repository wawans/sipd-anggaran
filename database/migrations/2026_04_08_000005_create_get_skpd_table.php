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
        Schema::create('get_skpd', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_skpd')->nullable()->index();
            $table->unsignedInteger('tahun')->nullable()->index();
            $table->unsignedBigInteger('id_daerah')->nullable()->index();
            $table->unsignedBigInteger('id_unit')->nullable()->index();
            $table->string('kode_unit')->nullable();
            $table->string('kode_skpd')->nullable();
            $table->string('nama_skpd')->nullable();
            $table->string('kode_opd')->nullable();

            $table->string('nama_kepala')->nullable();
            $table->string('nip_kepala')->nullable();
            $table->string('pangkat_kepala')->nullable();
            $table->string('status_kepala')->nullable();

            $table->unsignedBigInteger('id_strategi')->nullable()->index();
            $table->unsignedBigInteger('id_bidang_urusan_1')->nullable()->index();
            $table->unsignedBigInteger('id_bidang_urusan_2')->nullable()->index();
            $table->unsignedBigInteger('id_bidang_urusan_3')->nullable()->index();

            $table->unsignedInteger('is_ppkd')->nullable();
            $table->unsignedInteger('is_skpd')->nullable();
            $table->unsignedInteger('is_pendapatan')->nullable();
            $table->unsignedInteger('is_pembiayaan')->nullable();
            $table->unsignedInteger('is_dpa_khusus')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('get_skpd');
    }
};
