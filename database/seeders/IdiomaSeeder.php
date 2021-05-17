<?php

namespace Database\Seeders;

use App\Models\Idioma;
use App\Utils\EnvConfig;
use Illuminate\Database\Seeder;

class IdiomaSeeder extends Seeder {
    public function run()
    {
        Idioma::create(Array(
            'nome'=> "Inglês",
            'sigla' => "en"
        ));
        Idioma::create(Array(
            'nome'=> "Português",
            'sigla' => "pt"
        ));
        Idioma::create(Array(
            'nome'=> "Russo",
            'sigla' => "ru"
        ));
        Idioma::create(Array(
            'nome'=> "Espanhol",
            'sigla' => "es"
        ));
        Idioma::create(Array(
            'nome'=> "Chinês",
            'sigla' => "zh"
        ));
    }
}