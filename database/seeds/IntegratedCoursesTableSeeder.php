<?php

use Illuminate\Database\Seeder;

class IntegratedCoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($iCtr = 1; $iCtr < 4; $iCtr++) {
            DB::table('integrated_courses')->insert([
                'integrated_course_name' => 'Integrated Course ' . $iCtr,
            ]);
        }
    }
}
