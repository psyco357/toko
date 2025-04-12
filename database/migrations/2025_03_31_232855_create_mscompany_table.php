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
        Schema::create('mscompany', function (Blueprint $table) {
            $table->id();
            $table->string('namecompany');
            $table->string('alamatcompany');
            $table->string('logocompany');
            $table->string('emailcompany');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mscompany');
    }
};
