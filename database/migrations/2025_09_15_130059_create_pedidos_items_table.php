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
        Schema::create('pedidos_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pedidos_id')->unsigned();
            $table->string('producto');
            $table->string('tipo')->nullable();
            $table->decimal('precio');
            $table->text('descripcion')->nullable();
            $table->text('imagen_path')->nullable();
            $table->string('almacen');
            $table->integer('cantidad');
            $table->bigInteger('productos_id')->unsigned()->nullable();
            $table->bigInteger('almacenes_id')->unsigned()->nullable();
            $table->foreign('pedidos_id')->references('id')->on('pedidos')->cascadeOnDelete();
            $table->foreign('productos_id')->references('id')->on('productos')->nullOnDelete();
            $table->foreign('almacenes_id')->references('id')->on('almacenes')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos_items');
    }
};
