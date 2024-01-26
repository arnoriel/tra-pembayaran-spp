<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Akun extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'azril',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'role' => '1',
            ],
            [
                'name' => 'azrildua',
                'email' => 'petugas@gmail.com',
                'password' => bcrypt('petugas'),
                'role' => '2',
            ],
            [
                'name' => 'azrilsiswa',
                'email' => 'azril@gmail.com',
                'password' => bcrypt('siswa'),
                'role' => '3',
            ],
        ];
        foreach($data as $key => $d){
            User::create($d);
        }
    }
}
