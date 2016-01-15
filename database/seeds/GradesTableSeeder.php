<?php

use App\Grade;
use Illuminate\Database\Seeder;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grade::create([
            'name' => 'Pre-kinder',
            'description' => 'Para niños de 2 y 3 años.'
        ]);

        Grade::create([
            'name' => 'Kinder',
            'description' => 'Para niños de 4 y 5 años.'
        ]);

        Grade::create([ 'name' => 'Primer grado' ]);
        Grade::create([ 'name' => 'Segundo grado' ]);
        Grade::create([ 'name' => 'Tercer grado' ]);
        Grade::create([ 'name' => 'Cuarto grado' ]);
        Grade::create([ 'name' => 'Quinto grado' ]);
        Grade::create([ 'name' => 'Sexto grado' ]);

        Grade::create([ 'name' => 'Primer año' ]);
        Grade::create([ 'name' => 'Segundo año' ]);
        Grade::create([ 'name' => 'Tercer año' ]);
        Grade::create([ 'name' => 'Cuarto año' ]);
        Grade::create([ 'name' => 'Quinto año' ]);

    }
}
