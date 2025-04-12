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
        Schema::create('tspenjualan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idstok');
            $table->bigInteger('idtoko');
            $table->bigInteger('idbarang');
            $table->integer('jual');
            $table->double('hargajual', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tspenjualan');
    }
};
