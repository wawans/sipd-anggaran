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
        Schema::create('skpd_sub', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sub_skpd')->nullable()->index();
            $table->unsignedInteger('tahun')->nullable()->index();
            $table->unsignedBigInteger('id_daerah')->nullable()->index();
            $table->string('kode_sub_skpd')->nullable();
            $table->text('nama_sub_skpd')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skpd_sub');
    }
};
