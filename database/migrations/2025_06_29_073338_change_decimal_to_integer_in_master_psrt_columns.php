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
            $table->integer('nilai_kehadiran')->change();
            $table->integer('nilai_kerapian')->change();
            $table->integer('nilai_sikap')->change();
            $table->integer('nilai_tanggungjawab')->change();
            $table->integer('nilai_kepatuhan')->change();
            $table->integer('nilai_komunikasi')->change();
            $table->integer('nilai_kerjasama')->change();
            $table->integer('nilai_inisiatif')->change();
            $table->integer('nilai_teknis1')->change();
            $table->integer('nilai_teknis2')->change();
            $table->integer('nilai_teknis3')->change();
            $table->integer('nilai_teknis4')->change();
            $table->integer('nilai_akhir')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_psrt', function (Blueprint $table) {
            $table->decimal('nilai_kehadiran', 5, 2)->change();
            $table->decimal('nilai_kerapian', 5, 2)->change();
            $table->decimal('nilai_sikap', 5, 2)->change();
            $table->decimal('nilai_tanggungjawab', 5, 2)->change();
            $table->decimal('nilai_kepatuhan', 5, 2)->change();
            $table->decimal('nilai_komunikasi', 5, 2)->change();
            $table->decimal('nilai_kerjasama', 5, 2)->change();
            $table->decimal('nilai_inisiatif', 5, 2)->change();
            $table->decimal('nilai_teknis1', 5, 2)->change();
            $table->decimal('nilai_teknis2', 5, 2)->change();
            $table->decimal('nilai_teknis3', 5, 2)->change();
            $table->decimal('nilai_teknis4', 5, 2)->change();
            $table->decimal('nilai_akhir', 5, 2)->change();
        });
    }
};
