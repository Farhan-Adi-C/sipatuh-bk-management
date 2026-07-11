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
        Schema::create('pelanggaran_siswas', function (Blueprint $table) {
             $table->id();
            $table->foreignId('siswa_id')->constrained("siswas")->cascadeOnDelete();
            $table->foreignId('jenis_pelanggaran_id')->constrained("jenis_pelanggarans")->cascadeOnDelete();
            $table->date("tanggal_pelanggaran")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggarans');
    }
};
