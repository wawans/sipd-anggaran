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
        Schema::create('anggaran_skpd', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('tahun')->nullable()->index();
            $table->unsignedBigInteger('id_daerah')->nullable()->index();
            $table->unsignedBigInteger('id_jadwal')->nullable()->index();
            $table->unsignedBigInteger('id_skpd')->nullable()->index();
            $table->unsignedBigInteger('id_unit')->nullable()->index();

            $table->string('kode_skpd')->nullable();
            $table->text('nama_skpd')->nullable();

            $table->decimal('set_pagu_skpd', 22)->nullable();
            $table->decimal('set_pagu_giat', 22)->nullable();
            $table->decimal('pagu_murni', 22)->nullable();
            $table->decimal('rinci_giat', 22)->nullable();

            $table->unsignedInteger('total_giat')->nullable();
            $table->unsignedInteger('belanja_terbuka')->nullable();
            $table->unsignedInteger('rincian_terbuka')->nullable();

            $table->boolean('status_getter')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggaran_skpd');
    }
};
