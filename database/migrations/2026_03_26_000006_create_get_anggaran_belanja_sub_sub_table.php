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
        Schema::create('get_anggaran_belanja_sub_sub', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_subs_sub_bl')->nullable()->index();
            $table->unsignedBigInteger('id_bl')->nullable()->index();
            $table->unsignedBigInteger('id_sub_bl')->nullable()->index();
            $table->unsignedInteger('tahun')->nullable()->index();
            $table->unsignedBigInteger('id_daerah')->nullable()->index();
            $table->unsignedBigInteger('id_unit')->nullable()->index();
            $table->text('subs_bl_teks')->nullable();
            $table->string('is_paket')->nullable();
            $table->unsignedBigInteger('id_jenis_barjas')->nullable()->index();
            $table->unsignedBigInteger('id_metode_barjas')->nullable()->index();
            $table->unsignedBigInteger('id_skpd')->nullable()->index();
            $table->unsignedBigInteger('id_sub_skpd')->nullable()->index();
            $table->unsignedBigInteger('id_program')->nullable()->index();
            $table->unsignedBigInteger('id_giat')->nullable()->index();
            $table->unsignedBigInteger('id_sub_giat')->nullable()->index();
            $table->text('nama_bl')->nullable();
            $table->text('nama_sub_bl')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('get_anggaran_belanja_sub_sub');
    }
};
