<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aCoursesCode = array('DSP-901', 'WEB-1', 'CISCO-1', 'DBMS-2209', 'PROG-2');
        $aCoursesTitle = array('Digital Signal Processing', 'Static Webpages', 'Cisco Fundamentals', 'Database Management and Systems', 'Advance Java');
        $sCourseStart = '02-03-2019';
        $sCourseEnd = '07-06-2019';
        $iCount = count($aCoursesCode);
        for ($iCtr = 0; $iCtr < $iCount; $iCtr++) {
            DB::table('courses')->insert([
                'course_code' => $aCoursesCode[$iCtr],
                'course_title'     => $aCoursesTitle[$iCtr],
                'course_start'     => $sCourseStart,
                'course_end'         =>  $sCourseEnd
            ]);
        }
    }
}
