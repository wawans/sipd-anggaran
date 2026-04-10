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
        Schema::create('get_giat_sub', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sub_giat')->nullable()->index();
            $table->unsignedInteger('tahun')->nullable()->index();
            $table->unsignedBigInteger('id_daerah')->nullable()->index();
            $table->unsignedBigInteger('id_urusan')->nullable()->index();
            $table->unsignedBigInteger('id_bidang_urusan')->nullable()->index();
            $table->unsignedBigInteger('id_program')->nullable()->index();
            $table->unsignedBigInteger('id_giat')->nullable()->index();
            $table->string('kode_sub_giat')->nullable();
            $table->text('nama_sub_giat')->nullable();
            $table->string('no_sub_giat')->nullable();

            $table->text('indikator')->nullable();
            $table->text('kinerja')->nullable();
            $table->string('satuan')->nullable();
            $table->unsignedInteger('jenis_sub_giat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('get_giat_sub');
    }
};
