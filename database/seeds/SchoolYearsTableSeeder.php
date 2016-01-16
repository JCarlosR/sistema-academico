<?php

use App\SchoolYear;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SchoolYearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carbon = Carbon::now('America/Lima');

        $year = $carbon->year;

        $start = clone $carbon;
        $start->firstOfYear();

        $end = clone $carbon;
        $end->lastOfYear();

        $prev_start = clone $start;
        $prev_start->subYear();

        $prev_end = clone $end;
        $prev_end->subYear();

        // A past school year
        SchoolYear::create([
            'name' => 'Año ' . ($year-1),
            'start' => $prev_start,
            'end' => $prev_end,
            'course_handbook_id' => 1 // malla curricular
        ]);

        // Current school year
        SchoolYear::create([
            'name' => 'Año ' . $year,
            'start' => $start,
            'end' => $end,
            'course_handbook_id' => 1 // malla curricular
        ]);
    }
}
