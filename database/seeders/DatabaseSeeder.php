<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kelas;
use App\Models\Student;
use App\Models\Subject;
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

       User::create([
            'name' => 'Admin Namanya',
            'email' => 'admin@mail.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role' => 'admin',
            'gender' => 'L',
            'dob' => Date::now(),
        ]);

        Kelas::create([
            'name' => 'X'
        ]);
        Kelas::create([
            'name' => 'XI'
        ]);
        Kelas::create([
            'name' => 'XII'
        ]);

        Subject::create([
            'name' => 'Matematika',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.'
        ]);
        Subject::create([
            'name' => 'Bahasa Inggrid',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.'
        ]);

        Student::create([
            'kelas_id' => 1,
            'nisn' => 1234567890,
            'gender' => 'L',
            'name' => 'Fani Apriadi',
            'dob' => date('Y-m-d H:m:s'),
            'address' => 'Jalan dulu aja jadian nanti',
        ]);
    }
}
