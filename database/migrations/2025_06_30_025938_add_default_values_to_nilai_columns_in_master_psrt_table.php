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
        Schema::table('master_psrt', function (Blueprint $table) {
            // Menambahkan nilai default 0 pada kolom nilai
            $table->integer('nilai_kehadiran')->default(0)->change();
            $table->integer('nilai_kerapian')->default(0)->change();
            $table->integer('nilai_sikap')->default(0)->change();
            $table->integer('nilai_tanggungjawab')->default(0)->change();
            $table->integer('nilai_kepatuhan')->default(0)->change();
            $table->integer('nilai_komunikasi')->default(0)->change();
            $table->integer('nilai_kerjasama')->default(0)->change();
            $table->integer('nilai_inisiatif')->default(0)->change();
            $table->integer('nilai_teknis1')->default(0)->change();
            $table->integer('nilai_teknis2')->default(0)->change();
            $table->integer('nilai_teknis3')->default(0)->change();
            $table->integer('nilai_teknis4')->default(0)->change();
            $table->integer('nilai_akhir')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('master_psrt', function (Blueprint $table) {
            $table->integer('nilai_kehadiran')->nullable()->change();
            $table->integer('nilai_kerapian')->nullable()->change();
            $table->integer('nilai_sikap')->nullable()->change();
            $table->integer('nilai_tanggungjawab')->nullable()->change();
            $table->integer('nilai_kepatuhan')->nullable()->change();
            $table->integer('nilai_komunikasi')->nullable()->change();
            $table->integer('nilai_kerjasama')->nullable()->change();
            $table->integer('nilai_inisiatif')->nullable()->change();
            $table->integer('nilai_teknis1')->nullable()->change();
            $table->integer('nilai_teknis2')->nullable()->change();
            $table->integer('nilai_teknis3')->nullable()->change();
            $table->integer('nilai_teknis4')->nullable()->change();
            $table->integer('nilai_akhir')->nullable()->change();
        });
    }
};
