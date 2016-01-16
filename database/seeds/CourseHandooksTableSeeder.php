<?php

use App\CourseHandbook;
use Illuminate\Database\Seeder;

class CourseHandooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseHandbook::create([
            'name' => 'Malla curricular 2016',
            'description' => 'Malla curricular actual de la institución educativa.'
        ]);
    }
}
