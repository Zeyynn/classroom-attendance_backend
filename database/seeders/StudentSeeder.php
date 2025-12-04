<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classrooms = \App\Models\Classroom::all();
        
        foreach ($classrooms as $classroom) {
            \App\Models\Student::factory(10)->create([
                'classroom_id' => $classroom->id
            ]);
        }
    }
}
