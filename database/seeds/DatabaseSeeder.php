<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles and users
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        // Study categories
        $this->call(GradesTableSeeder::class);

        // Courses and assignments
        $this->call(CoursesTableSeeder::class);
        $this->call(CourseHandooksTableSeeder::class);

        // Study seasons
        $this->call(SchoolYearsTableSeeder::class);
        $this->call(PeriodsTableSeeder::class);
        $this->call(UnitsTableSeeder::class);


    }
}
