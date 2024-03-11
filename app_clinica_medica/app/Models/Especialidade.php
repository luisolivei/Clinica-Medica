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

    


}
