<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin Bimbel',
            'email' => 'adminbimbel@gmail.com',
            'password' => Hash::make('adminbimbel'),
            'role' => 'admin',
        ]);

        $guruUser = User::create([
            'name' => 'Guru Bimbel',
            'email' => 'gurubimbel@gmail.com',
            'password' => Hash::make('gurubimbel'),
            'role' => 'guru',
        ]);

        $siswaUser = User::create([
            'name' => 'Siswa Bimbel',
            'email' => 'siswabimbel@gmail.com',
            'password' => Hash::make('siswabimbel'),
            'role' => 'siswa',
        ]);

        $classRoom = ClassRoom::create([
            'code' => 'KLS001',
            'name' => 'Kelas Bimbel A',
            'status' => 'active',
        ]);

        Teacher::create([
            'user_id' => $guruUser->id,
            'name' => 'Guru Bimbel',
            'identity_number' => 'G001',
            'gender' => 'male',
            'phone' => '081234567890',
            'address' => 'Jakarta',
            'status' => 'active',
        ]);

        Student::create([
            'user_id' => $siswaUser->id,
            'class_room_id' => $classRoom->id,
            'name' => 'Siswa Bimbel',
            'identity_number' => 'S001',
            'gender' => 'male',
            'phone' => '081234567891',
            'address' => 'Jakarta',
            'status' => 'active',
        ]);
    }
}
