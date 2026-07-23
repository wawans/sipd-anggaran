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
        Schema::create('anggaran_belanja_sub_rinci', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rinci_sub_bl')->nullable()->index();
            $table->unsignedBigInteger('id_subs_sub_bl')->nullable()->index();
            $table->unsignedBigInteger('id_ket_sub_bl')->nullable()->index();
            $table->unsignedBigInteger('id_sub_bl')->nullable()->index();
            $table->unsignedInteger('tahun')->nullable()->index();
            $table->unsignedBigInteger('id_daerah')->nullable()->index();
            $table->unsignedBigInteger('id_standar_harga')->nullable()->index();
            $table->string('kode_standar_harga')->nullable();
            $table->text('nama_standar_harga')->nullable();

            $table->text('koefisien')->nullable();
            $table->string('koefisien_volume_1', 30)->nullable();
            $table->string('koefisien_satuan_1', 30)->nullable();
            $table->string('koefisien_volume_2', 30)->nullable();
            $table->string('koefisien_satuan_2', 30)->nullable();
            $table->string('koefisien_volume_3', 30)->nullable();
            $table->string('koefisien_satuan_3', 30)->nullable();
            $table->string('koefisien_volume_4', 30)->nullable();
            $table->string('koefisien_satuan_4', 30)->nullable();

            $table->decimal('harga_satuan', 22)->nullable();
            $table->decimal('total_harga', 22)->nullable();

            $table->unsignedBigInteger('id_akun')->nullable()->index();
            $table->string('kode_akun')->nullable();
            $table->text('nama_akun')->nullable();
            $table->text('spek')->nullable();

            $table->string('akun_locked')->nullable();
            $table->string('ssh_locked')->nullable();
            $table->string('penerima_bantuan')->nullable();

            $table->text('koefisien_murni')->nullable();
            $table->string('koefisien_murni_volume_1', 30)->nullable();
            $table->string('koefisien_murni_satuan_1', 30)->nullable();
            $table->string('koefisien_murni_volume_2', 30)->nullable();
            $table->string('koefisien_murni_satuan_2', 30)->nullable();
            $table->string('koefisien_murni_volume_3', 30)->nullable();
            $table->string('koefisien_murni_satuan_3', 30)->nullable();
            $table->string('koefisien_murni_volume_4', 30)->nullable();
            $table->string('koefisien_murni_satuan_4', 30)->nullable();

            $table->decimal('harga_satuan_murni', 22)->nullable();
            $table->decimal('total_harga_murni', 22)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggaran_belanja_sub_rinci');
    }
};
