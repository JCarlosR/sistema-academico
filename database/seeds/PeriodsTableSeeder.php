<?php

use App\Period;
use App\SchoolYear;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carbon = Carbon::now('America/Lima');

        // Current year
        $year = $carbon->year;

        // Getting the current school year
        $schoolYear = SchoolYear::all()->last();

        // Calculating the middle date
        $middle = clone $schoolYear->start;
        $middle->addMonths(6);

        // First period of the current school year
        Period::create([
            'school_year_id' => $schoolYear->id,
            'name' => $year . '-I',
            'start' => $schoolYear->start,
            'end' => $middle
        ]);

        // Last period of the current school year
        Period::create([
            'school_year_id' => $schoolYear->id,
            'name' => $year . '-II',
            'start' => $middle->addDay(),
            'end' => $schoolYear->end
        ]);
    }
}
