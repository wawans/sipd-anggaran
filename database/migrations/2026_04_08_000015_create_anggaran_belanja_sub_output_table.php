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
        Schema::create('anggaran_belanja_sub_output', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_output_bl')->nullable()->index();
            $table->unsignedInteger('tahun')->nullable()->index();
            $table->unsignedBigInteger('id_daerah')->nullable()->index();
            $table->unsignedBigInteger('id_unit')->nullable()->index();
            $table->unsignedBigInteger('id_bl')->nullable()->index();
            $table->unsignedBigInteger('id_sub_bl')->nullable()->index();

            $table->text('tolak_ukur')->nullable();
            $table->string('target')->nullable();
            $table->string('satuan')->nullable();
            $table->string('target_teks')->nullable();
            $table->text('tolok_ukur_sub')->nullable();
            $table->string('target_sub')->nullable();
            $table->string('satuan_sub')->nullable();
            $table->string('target_sub_teks')->nullable();

            $table->unsignedBigInteger('id_skpd')->nullable()->index();
            $table->unsignedBigInteger('id_sub_skpd')->nullable()->index();
            $table->unsignedBigInteger('id_program')->nullable()->index();
            $table->unsignedBigInteger('id_giat')->nullable()->index();
            $table->unsignedBigInteger('id_sub_giat')->nullable()->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggaran_belanja_sub_output');
    }
};
