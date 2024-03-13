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
        Schema::create('consulta_especialidade', function (Blueprint $table) {
            $table->unsignedBigInteger('id_consultas');
            $table->unsignedBigInteger('id_especialidades');
            $table->foreign('id_consultas')->references('id')->on('consultas')->onDelete('cascade');
            $table->foreign('id_especialidades')->references('id')->on('especialidades')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consulta_especialidade');
    }
};
