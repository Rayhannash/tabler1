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
        Schema::create('master_mgng', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_sklh');
            $table->foreign('id_sklh')->references('id')->on('master_sklh')->onUpdate('CASCADE')->onDelete('CASCADE');
            //Permintaan
            $table->string('nomor_surat_permintaan')->unique();
            $table->date('tanggal_surat_permintaan')->nullable();
            $table->string('perihal_surat_permintaan')->nullable();
            $table->string('ditandatangani_oleh')->nullable();
            $table->string('scan_surat_permintaan')->nullable();
            $table->string('scan_proposal_magang')->nullable();
            $table->enum('status_surat_permintaan',['belum','terkirim'])->default('belum');
            $table->enum('status_baca_surat_permintaan',['belum','dibaca'])->default('belum');
            //balasan
            $table->string('nomor_surat_balasan')->nullable();
            $table->date('tanggal_surat_balasan')->nullable();
            $table->enum('sifat_surat_balasan',['biasa','penting','segera'])->default('biasa');
            $table->enum('metode_magang',['offline','online'])->default('offline');
            $table->enum('lampiran_surat_balasan',['tidakada','selembar'])->default('tidakada');
            $table->string('scan_surat_balasan')->nullable();
            $table->date('tanggal_awal_magang')->nullable();
            $table->date('tanggal_akhir_magang')->nullable();
            $table->enum('status_surat_balasan',['belum','terkirim'])->default('belum');
            $table->enum('status_baca_surat_balasan',['belum','dibaca','belumbacaupdate','dibacaupdate'])->default('belum');
            $table->unsignedInteger('id_bdng_member')->nullable();
            $table->foreign('id_bdng_member')->references('id')->on('master_bdng_member')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->timestamps();
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_mgng');
    }
};
