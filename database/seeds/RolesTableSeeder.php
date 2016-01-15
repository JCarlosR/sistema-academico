<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([ 'name' => 'Administrador' ]); // 1
        Role::create([ 'name' => 'Alumno' ]); // 2
        Role::create([ 'name' => 'Docente' ]); // 3
        Role::create([ 'name' => 'Secretaria' ]);
        Role::create([ 'name' => 'Bibliotecario' ]);
    }
}
