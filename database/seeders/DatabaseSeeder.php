<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kelas;
use App\Models\KelasLevel;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Student::create([
            'kelas_id' => 1,
            'nisn' => 1234567890,
            'gender' => 'L',
            'name' => 'Fani Apriadi',
            'dob' => date('Y-m-d H:m:s'),
            'address' => 'Jalan dulu aja jadian nanti',
        ]);

        $currentYear = date('Y');

        Schoolyear::create([
            'start_year' => $currentYear,
            'end_year' => 2024,
            'semester_type' => 'gasal',
        ]);

        KelasLevel::create([
            'level' => 'X'
        ]);
        KelasLevel::create([
            'level' => 'XI'
        ]);
        KelasLevel::create([
            'level' => 'XII'
        ]);

        Kelas::create([
            'name' => 'MIPA 1',
            'schoolyear_id' => 1,
            'kelas_level_id' => 2,
        ]);

        // user
        $user1 = User::create([
            'email' => 'admin@mail.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role' => 'admin',
        ]);

        // Teacher
        $guru = Teacher::create([
            'user_id' => $user1->id,
            'nuptk' => 1234567890123456,
            'name' => 'Admin',
            'gender' => 'L',
            'dob' =>  date('Y-m-d H:m:s'),
            'address' =>  'Lorem ipsum dolor sit amet consectetur, adipisicing elit.',
        ]);

        Subject::create([
            'name' => 'Matematika',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            'teacher_id' => $guru->id,
        ]);
        Subject::create([
            'name' => 'Bahasa Inggrid',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.'
        ]);
    }
}
