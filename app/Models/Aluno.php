<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'foto'];

    public function Regras() {
        return [
            'nome' => 'required|unique|min:3',
            'foto' => 'required|file'
            // 'foto' => 'required|file|mimes:png,jpg'
        ];
    }

    public function Feedback() {
        return [
            'required' => 'O campo :attribute é obrigatório',
            // 'foto.mimes' => 'O arquivo deve ser uma imagem em PNG ou JPG',
            'nome.unique' => 'O nome do aluno já existe',
            'nome.min' => 'O nome do aluno deve ser maior que 3 caracteres'
        ];
    }
}
