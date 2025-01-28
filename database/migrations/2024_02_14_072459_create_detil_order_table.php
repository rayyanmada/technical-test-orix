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
        Schema::create('detil_order', function (Blueprint $table) {
            $table->id();
            $table->string('no_pinjaman', 15);
            $table->foreignId('inventory_id', 15);
            $table->integer('qtt');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->integer('durasi');
            $table->double('nominal');
            $table->enum('status', ['Tepat waktu', 'Terlambat']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detil_order');
    }
};
