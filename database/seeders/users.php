<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Carlos Ferreira',
            'email'     => 'carlos@especializati.com.br',
            'password'  => bcrypt('MinhaSenhaAqui')
        ]);
    }
}
