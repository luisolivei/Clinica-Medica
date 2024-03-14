<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pacientes',
        'NumeroConsulta',
        'data_consulta',
        'hora_consulta',
        'status_consulta',
        'descricao_consulta',
    ];


    public function rules()
    {
        return [
            'id_pacientes' => 'required',
            'NumeroConsulta' => 'required',
            'descricao_consulta' => 'required',
            'data_consulta' => 'required',
            'hora_consulta' => 'required',
            'status_consulta' => 'required',
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute deve ser preenchido',
        ];
    }


    public function paciente()
    {
        // uma consulta tem um paciente
        return $this->belongsTo(Paciente::class, 'id_pacientes');
    }

    public function agenda()
    {
        // uma consulta tem uma agenda
        return $this->belongsTo(Agenda::class, 'id_agendas');
    }

    public function especialidade()
    {
        // uma consulta tem muitas especialidades
        return $this->belongsToMany(Especialidade::class , 'consulta_especialidade', 'id_consultas', 'id_especialidades');
    }


}
