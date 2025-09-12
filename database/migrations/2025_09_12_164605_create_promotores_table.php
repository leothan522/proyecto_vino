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
        Schema::create('promotores', function (Blueprint $table) {
            $table->id();
            $table->string('cedula')->unique();
            $table->bigInteger('users_id')->unsigned();
            $table->bigInteger('almacenes_id')->unsigned()->nullable();
            $table->foreign('users_id')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('promotores');
    }
};
