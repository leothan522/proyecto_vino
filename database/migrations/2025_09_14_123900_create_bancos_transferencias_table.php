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
        Schema::create('bancos_transferencias', function (Blueprint $table) {
            $table->id();
            $table->string('titular');
            $table->string('cuenta');
            $table->string('rif');
            $table->string('tipo');
            $table->string('banco');
            $table->boolean('is_main')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bancos_transferencias');
    }
};
