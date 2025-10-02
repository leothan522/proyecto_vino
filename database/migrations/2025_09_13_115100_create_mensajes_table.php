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
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->string('nombre');
            $table->string('email');
            $table->string('telefono');
            $table->string('asunto');
            $table->text('mensaje');
            $table->bigInteger('users_id')->unsigned()->nullable();
            $table->boolean('visto')->default(false);
            $table->foreign('users_id')->references('id')->on('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }
};
