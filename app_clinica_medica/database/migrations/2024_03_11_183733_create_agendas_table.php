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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_medicos');
            $table->foreign('id_medicos')->references('id')->on('medicos')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_consultas');
            $table->foreign('id_consultas')->references('id')->on('consultas')->onDelete('cascade')->onUpdate('cascade');
            $table->date('data_agenda');
            $table->time('hora_agenda');
            $table->enum('status_agenda', ['Agendada', 'Cancelada', 'Realizada']);  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
