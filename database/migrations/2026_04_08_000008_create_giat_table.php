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
        Schema::create('giat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_giat')->nullable()->index();
            $table->unsignedInteger('tahun')->nullable()->index();
            $table->unsignedBigInteger('id_daerah')->nullable()->index();
            $table->unsignedBigInteger('id_urusan')->nullable()->index();
            $table->unsignedBigInteger('id_bidang_urusan')->nullable()->index();
            $table->unsignedBigInteger('id_program')->nullable()->index();
            $table->string('kode_giat')->nullable();
            $table->text('nama_giat')->nullable();
            $table->string('no_giat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giat');
    }
};
