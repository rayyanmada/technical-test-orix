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
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();
            $table->string('no_order', 15);
            $table->foreignId('customer_id');
            $table->date('tgl_kembali');
            $table->integer('durasi');
            $table->integer('terlambat');
            $table->string('keterangan');
            $table->enum('status', ['Tepat Waktu', 'Terlambat']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
