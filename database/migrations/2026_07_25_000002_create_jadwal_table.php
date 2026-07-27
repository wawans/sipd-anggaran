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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jadwal')->unique();
            $table->unsignedInteger('tahun')->nullable()->index();
            $table->unsignedBigInteger('id_daerah')->nullable()->index();
            $table->unsignedBigInteger('id_tahap')->nullable()->index();
            $table->string('nama_sub_tahap')->nullable();
            $table->dateTime('waktu_mulai')->nullable();
            $table->dateTime('waktu_selesai')->nullable();
            $table->tinyInteger('is_perubahan')->nullable();
            $table->unsignedBigInteger('id_jadwal_murni')->nullable()->index();
            $table->tinyInteger('is_pembahasan')->nullable();
            $table->unsignedBigInteger('id_jadwal_pembahasan')->nullable()->index();
            $table->tinyInteger('is_locked')->nullable();
            $table->tinyInteger('is_public')->nullable();
            $table->tinyInteger('is_rinci_bl')->nullable();
            $table->unsignedBigInteger('id_sub_rkpd')->nullable()->index();
            $table->string('no_registrasi')->nullable();
            $table->string('no_perda')->nullable();
            $table->dateTime('tgl_perda')->nullable();
            $table->string('no_perkada')->nullable();
            $table->dateTime('tgl_perkada')->nullable();
            $table->dateTime('tgl_rka')->nullable();
            $table->string('tandai_jadwal')->nullable();
            $table->unsignedBigInteger('id_jadwal_rpjmd')->nullable()->index();
            $table->string('rkpd_murni')->nullable();
            $table->string('rkpd_pak')->nullable();
            $table->string('kua_murni')->nullable();
            $table->string('kua_pak')->nullable();
            $table->string('rollback_jadwal')->nullable();
            $table->string('rollback_teks')->nullable();
            $table->string('geser_khusus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
