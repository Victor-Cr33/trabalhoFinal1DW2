<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model {

    use HasFactory;
    use SoftDeletes;

    protected $table = "alunos";
    protected $fillable = ['nome','curso_id'];


    public function disciplina() {
        return $this->belongsToMany('\App\Models\Disciplina');
    }

    public function curso(){
        return $this->belongsTo('\App\Models\Curso');
    }
}
