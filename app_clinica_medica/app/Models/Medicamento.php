<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'dosagem',
        'descricao',
        'data_validade',
    ];

    public function rules()
    {
        return [
            'nome' => 'required|unique:medicamentos,nome,' . $this->id . ' |min:3',
            'dosagem' => 'required',
            'descricao' => 'required',
            'data_validade' => 'required',
        ];
    }


}
