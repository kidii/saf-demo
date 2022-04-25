<?php

namespace Database\Seeders;

use App\Models\StudyGroup;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudyGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $studyGroupNames = array(
            'Typography',
            'Biologists',
            'Chemistry Capital',
            'Web designers',
            'Black magicians',
            'Lame gamer boys'
        );

        foreach($studyGroupNames as $studyGroupName) {
            StudyGroup::factory()->create([
                'name' => $studyGroupName
            ]);
        }
    }
}
