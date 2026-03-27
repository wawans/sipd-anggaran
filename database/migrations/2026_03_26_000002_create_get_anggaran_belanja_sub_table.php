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
        Schema::create('get_anggaran_belanja_sub', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_sub_bl')->nullable()->index();
            $table->unsignedBigInteger('id_daerah')->nullable()->index();
            $table->unsignedBigInteger('tahun')->nullable()->index();
            $table->unsignedBigInteger('id_unit')->nullable()->index();
            $table->unsignedBigInteger('id_skpd')->nullable()->index();

            $table->string('kode_skpd')->nullable();
            $table->string('nama_skpd')->nullable();

            $table->unsignedBigInteger('id_urusan')->nullable()->index();
            $table->string('kode_urusan')->nullable();
            $table->string('nama_urusan')->nullable();

            $table->unsignedBigInteger('id_bidang_urusan')->nullable()->index();
            $table->string('kode_bidang_urusan')->nullable();
            $table->string('nama_bidang_urusan')->nullable();

            $table->unsignedBigInteger('id_sub_skpd')->nullable()->index();
            $table->string('kode_sub_skpd')->nullable();
            $table->string('nama_sub_skpd')->nullable();

            $table->unsignedBigInteger('id_program')->nullable()->index();
            $table->string('kode_program')->nullable();
            $table->string('nama_program')->nullable();

            $table->unsignedBigInteger('id_giat')->nullable()->index();
            $table->string('kode_giat')->nullable();
            $table->text('nama_giat')->nullable();

            $table->decimal('pagu_giat', 22)->nullable();
            $table->decimal('rinci_giat', 22)->nullable();

            $table->unsignedBigInteger('id_sub_giat')->nullable()->index();
            $table->string('kode_sub_giat')->nullable();
            $table->text('nama_sub_giat')->nullable();

            $table->decimal('pagu_murni', 22)->nullable();
            $table->decimal('pagu', 22)->nullable();
            $table->decimal('pagu_indikatif', 22)->nullable();
            $table->decimal('rincian', 22)->nullable();

            $table->string('kode_bl')->nullable();
            $table->string('kode_sbl')->nullable();
            $table->string('kunci_bl')->nullable();
            $table->string('kunci_bl_rinci')->nullable();
            $table->string('is_locked')->nullable();

            $table->boolean('status_getter')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('get_anggaran_belanja_sub');
    }
};
