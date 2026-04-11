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
        Schema::create('get_dana', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dana')->nullable()->index();
            $table->unsignedInteger('tahun')->nullable()->index();
            $table->unsignedBigInteger('id_daerah')->nullable()->index();
            $table->string('kode_dana')->nullable();
            $table->text('nama_dana')->nullable();
            $table->text('sumber_dana')->nullable();
            // $table->unsignedBigInteger('id_jns_dana')->nullable()->index();
            // $table->unsignedBigInteger('id_type_dana')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('get_dana');
    }
};
