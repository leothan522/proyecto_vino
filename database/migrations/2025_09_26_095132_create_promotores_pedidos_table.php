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
        Schema::create('promotores_pedidos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('promotores_id')->unsigned();
            $table->bigInteger('pedidos_id')->unsigned();
            $table->integer('cantidad')->default(0);
            $table->foreign('promotores_id')->references('id')->on('promotores')->cascadeOnDelete();
            $table->foreign('pedidos_id')->references('id')->on('pedidos')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotores_pedidos');
    }
};
