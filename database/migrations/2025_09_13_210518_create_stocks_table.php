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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('almacenes_id')->unsigned();
            $table->bigInteger('productos_id')->unsigned();
            $table->integer('disponibles')->nullable();
            $table->integer('comprometidos')->nullable();
            $table->integer('vendidos')->nullable();
            $table->foreign('almacenes_id')->references('id')->on('almacenes');
            $table->foreign('productos_id')->references('id')->on('productos');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
