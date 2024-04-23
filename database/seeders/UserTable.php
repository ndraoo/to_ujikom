<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
            'username' => 'user',
            'nama_lengkap' => 'ini akun user (non admin)',
            'level' => 'user',
            'email' => 'test1@gmail.com',
            'password' => '12345678',
            'alamat' => 'test',
            ],
            [
            'username' => 'admin',
            'nama_lengkap' => 'ini akun Admin',
            'level' => 'admin',
            'email' => 'test2@gmail.com',
            'password' => '12345678',
            'alamat' => 'test',
            ],
            [
            'username' => 'petugas',
            'nama_lengkap' => 'ini akun petugas (non admin)',
            'level' => 'petugas',
            'email' => 'test3@gmail.com',
            'password' => '12345678',
            'alamat' => 'test',
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
