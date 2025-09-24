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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->bigInteger('tipos_id')->unsigned()->nullable();
            $table->decimal('precio', 12, 2)->nullable();
            $table->text('descripcion')->nullable();
            $table->text('imagen_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreign('tipos_id')->references('id')->on('tipos_productos')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
