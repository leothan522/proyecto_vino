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
        Schema::create('pedidos_repartidores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedidos_id');
            $table->unsignedBigInteger('repartidores_id');
            $table->foreign('pedidos_id')->references('id')->on('pedidos')->cascadeOnDelete();
            $table->foreign('repartidores_id')->references('id')->on('repartidores')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos_repartidores');
    }
};
