<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\StudyGroup;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentStudyGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::withoutEvents(function () {
            Student::chunkById(10, function ($student) {
                $student->each(function ($s) {
                    $s->studyGroups()->sync(StudyGroup::get()->random(rand(0,4)));
                });
            });
        });
    }
}
