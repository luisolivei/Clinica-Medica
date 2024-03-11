<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_paciente',
        'genero',
        'morada',
        'nif',
        'data_nascimento',
        'telemovel',
        'email',
    ];


    public function rules()
    {
        return [
            'nome_paciente' => 'required|unique:pacientes,nome_paciente,' . $this->id . '|min:3',
            'morada' => 'required',
            'data_nascimento' => 'required',
            'telemovel' => 'required|max:12|unique:pacientes,telemovel,' . $this->id,
            'email' => 'required|unique:pacientes,email,' . $this->id,
            'nif' => 'required|unique:pacientes,nif,' . $this->id,
            'genero' => 'required',
        ];
    }
}
