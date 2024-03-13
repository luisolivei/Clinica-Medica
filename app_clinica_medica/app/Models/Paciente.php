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
        'imagem',
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
            'imagem' =>'required |file|mimes:jpeg,png'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute deve ser preenchido',
            'telemovel.max' => 'O campo :attribute deve ter no maximo 12 carateres',
            'unique' => 'O campo :attribute deve ser unico',
            'nome.min' => 'O campo :attribute deve ter no minimo 3 carateres',
            'imagem.mimes' => 'O arquivo deve ser jpeg ou png',

        ];
    }

    public function consultas()

    {
        // um paciente tem muitas consultas
        return $this->hasMany(Consulta::class, 'id_pacientes', 'id');
    }

}
