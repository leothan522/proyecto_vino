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
        Schema::create('carritos', function (Blueprint $table) {
            $table->id();
            $table->string('rowquid');
            $table->bigInteger('productos_id')->unsigned();
            $table->bigInteger('almacenes_id')->unsigned();
            $table->integer('cantidad');
            $table->boolean('checkout')->default(false);
            $table->foreign('productos_id')->references('id')->on('productos')->cascadeOnDelete();
            $table->foreign('almacenes_id')->references('id')->on('almacenes')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carritos');
    }
};
