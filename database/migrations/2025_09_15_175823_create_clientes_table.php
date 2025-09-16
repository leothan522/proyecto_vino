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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('cedula')->unique();
            $table->string('nombre');
            $table->string('telefono');
            $table->bigInteger('parroquias_id')->unsigned()->nullable();
            $table->text('direccion');
            $table->text('direccion2')->nullable();
            $table->bigInteger('users_id')->unsigned()->nullable();
            $table->foreign('parroquias_id')->references('id')->on('parroquias')->nullOnDelete();
            $table->foreign('users_id')->references('id')->on('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
