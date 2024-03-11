<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_especialidade',
    ];


    public function rules()
    {
        return [
            'nome_especialidade' => 'required|unique:especialidades,nome_especialidade,' . $this->id . '|min:3',
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute deve ser preenchido',
            'unique' => 'O campo :attribute deve ser unico',
            'min' => 'O campo :attribute deve ter pelo menos 3 caracteres',
        ];
    }




}