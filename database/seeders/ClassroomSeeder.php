<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Classroom;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classroom::create([
            'classroom_name' => 'Class A - Ambitious',
            'classroom_description' => 'Accounting Class'
        ]);
    
        Classroom::create([
            'classroom_name' => 'Class B - Brilliant',
            'classroom_description' => 'Computer Science Class'
        ]);
    
        Classroom::create([
            'classroom_name' => 'Class C - Competent',
            'classroom_description' => 'Economics Class'
        ]);

        Classroom::create([
            'classroom_name' => 'Class D - Dynamic',
            'classroom_description' => 'Science Class'
        ]);

        Classroom::create([
            'classroom_name' => 'Class E - Efficient',
            'classroom_description' => 'Science Below Class'
        ]);

        Classroom::create([
            'classroom_name' => 'Class F - Fabulous',
            'classroom_description' => 'Architecture Class'
        ]);

        Classroom::create([
            'classroom_name' => 'Class G - Great',
            'classroom_description' => 'Arab Class'
        ]);
    }
    
}
