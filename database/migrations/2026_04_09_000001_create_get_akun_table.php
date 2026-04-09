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
        Schema::create('get_akun', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_akun')->nullable()->index();
            $table->unsignedInteger('tahun')->nullable()->index();
            $table->unsignedBigInteger('id_daerah')->nullable()->index();
            $table->string('kode_akun')->nullable();
            $table->string('nama_akun')->nullable();
            $table->unsignedInteger('is_pendapatan')->nullable();
            $table->unsignedInteger('is_bl')->nullable();
            $table->unsignedInteger('is_pembiayaan')->nullable();
            $table->unsignedInteger('is_gaji_asn')->nullable();
            $table->unsignedInteger('is_barjas')->nullable();
            $table->unsignedInteger('is_bunga')->nullable();
            $table->unsignedInteger('is_subsidi')->nullable();
            $table->unsignedInteger('is_bagi_hasil')->nullable();
            $table->unsignedInteger('is_bankeu_umum')->nullable();
            $table->unsignedInteger('is_bankeu_khusus')->nullable();
            $table->unsignedInteger('is_btt')->nullable();
            $table->unsignedInteger('is_hibah_brg')->nullable();
            $table->unsignedInteger('is_hibah_uang')->nullable();
            $table->unsignedInteger('is_sosial_brg')->nullable();
            $table->unsignedInteger('is_sosial_uang')->nullable();
            $table->unsignedInteger('is_bos')->nullable();
            $table->unsignedInteger('is_modal_tanah')->nullable();
            $table->unsignedInteger('is_tkdn')->nullable();
            $table->unsignedInteger('is_miskin')->nullable();
            $table->unsignedInteger('level')->nullable();
            $table->unsignedInteger('mulai_tahun')->nullable();
            $table->unsignedInteger('kunci_tahun')->nullable();
            $table->string('ket_akun')->nullable();
            $table->unsignedInteger('set_prov')->nullable();
            $table->unsignedInteger('set_kab_kota')->nullable();
            $table->unsignedBigInteger('id_jns_dana')->nullable()->index();
            $table->string('kode_akun_lama')->nullable();
            $table->string('kode_akun_revisi')->nullable();
            $table->string('pendapatan')->nullable();
            $table->string('belanja')->nullable();
            $table->string('pembiayaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('get_akun');
    }
};
