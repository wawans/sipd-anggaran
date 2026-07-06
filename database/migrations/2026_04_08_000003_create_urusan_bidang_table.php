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
        Schema::create('urusan_bidang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bidang_urusan')->nullable()->index();
            $table->unsignedInteger('tahun')->nullable()->index();
            $table->unsignedBigInteger('id_daerah')->nullable()->index();
            $table->unsignedBigInteger('id_urusan')->nullable()->index();
            $table->unsignedBigInteger('id_fungsi')->nullable()->index();
            $table->string('kode_bidang_urusan')->nullable();
            $table->text('nama_bidang_urusan')->nullable();
            $table->text('bidang_urusan_alias')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urusan_bidang');
    }
};
