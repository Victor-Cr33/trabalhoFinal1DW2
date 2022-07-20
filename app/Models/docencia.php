<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Docencia extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "docencias";
    protected $fillable = ['professor_id', 'disciplina_id'];
}
