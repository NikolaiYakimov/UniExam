<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subject::create([
            'subject_name'=>'ПТС',
            'description'=>'Изучаване на основните похвати в Програмирането',
            'semester'=>'3'
        ]);

        Subject::create([
            'subject_name'=>'ВПКС',
            'description'=>'Изучаване на електрически схеми, материали и тн.',
            'semester'=>'5'
        ]);

        Subject::create([
            'subject_name'=>'ОМТ',
            'description'=>'Изучаване на основните мрежови технологии',
            'semester'=>'3'
        ]);
    }
}
