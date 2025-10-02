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
        Schema::create('pedidos_pagos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pedidos_id')->unsigned();
            $table->string('metodo');
            $table->string('referencia');
            $table->decimal('monto', 12, 2);
            $table->string('titular')->nullable();
            $table->string('cuenta')->nullable();
            $table->string('rif')->nullable();
            $table->string('tipo')->nullable();
            $table->string('banco')->nullable();
            $table->string('codigo')->nullable();
            $table->string('telefono')->nullable();
            $table->boolean('is_validated')->default(false);
            $table->dateTime('validated')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_telefono')->nullable();
            $table->bigInteger('users_id')->unsigned()->nullable();
            $table->foreign('pedidos_id')->references('id')->on('pedidos')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos_pagos');
    }
};
