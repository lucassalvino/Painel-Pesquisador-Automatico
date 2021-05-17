<?php
namespace App\Models;

use App\Models\Bases\BaseModel;

Class Idioma extends BaseModel{
    protected $table = 'idioma';
    protected $fillable = [
        'id', 'nome', 'sigla'
    ];
}