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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique()->nullable();
            $table->string('cedula')->nullable();
            $table->string('nombre')->nullable();
            $table->string('parroquia')->nullable();
            $table->string('telefono')->nullable();
            $table->text('direccion')->nullable();
            $table->text('direccion2')->nullable();
            $table->decimal('subtotal')->nullable();
            $table->decimal('entrega')->nullable();
            $table->decimal('total')->nullable();
            $table->string('rowquid');
            $table->boolean('is_process')->default(true);
            $table->bigInteger('users_id')->unsigned()->nullable();
            $table->bigInteger('almacenes_id')->unsigned()->nullable();
            $table->foreign('users_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('almacenes_id')->references('id')->on('almacenes')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
