<?php

namespace Database\Seeders;

use App\Models\User;
use App\Utils\EnvConfig;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    public function run()
    {
        User::create(Array(
            'name'=> "kame",
            'email' => "lucassalvino1@gmail.com",
            'path_avatar' => 'imagens\1bab6d41_20cc_492e_b622_153a4f408f99.jpg',
            'password' => hash(EnvConfig::HashSenha(), 'Mudar@1234!'),
            'cadastro_aprovado' => true
        ));
    }
}