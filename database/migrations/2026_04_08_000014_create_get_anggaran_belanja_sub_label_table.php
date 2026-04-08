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
        Schema::create('get_anggaran_belanja_sub_label', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_label_bl')->nullable()->index();
            $table->unsignedInteger('tahun')->nullable()->index();
            $table->unsignedBigInteger('id_daerah')->nullable()->index();
            $table->unsignedBigInteger('id_unit')->nullable()->index();
            $table->unsignedBigInteger('id_bl')->nullable()->index();
            $table->unsignedBigInteger('id_sub_bl')->nullable()->index();
            $table->unsignedBigInteger('id_label_pusat')->nullable()->index();
            $table->unsignedBigInteger('id_label_prov')->nullable()->index();
            $table->unsignedBigInteger('id_label_kokab')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('get_anggaran_belanja_sub_label');
    }
};
