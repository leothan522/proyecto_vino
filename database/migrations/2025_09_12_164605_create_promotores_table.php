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
            $table->string('codigo')->unique();
            $table->date('inicio_comision')->nullable();
            $table->integer('meses_comision')->nullable();
            $table->integer('stock_vendidos')->default(0)->nullable();
            $table->boolean('is_active')->default(true);
            $table->bigInteger('users_id')->unsigned();
            $table->text('image_qr')->nullable();
            $table->foreign('users_id')->references('id')->on('users')->cascadeOnDelete();
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
