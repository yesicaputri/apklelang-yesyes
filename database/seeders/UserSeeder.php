<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [
            [
                'nama_petugas'  => 'admin',
                'username'      => 'admin',
                'password'      => bcrypt('admin'),
                'level'         => 'admin',
                'telp'          => '0812'
            ],
            [
                'nama_petugas'  => 'petugas',
                'username'      => 'petugas',
                'password'      => bcrypt('petugas'),
                'level'         => 'petugas',
                'telp'          => '0813'
            ],
            [
                'nama_petugas'  => 'masyarakat',
                'username'      => 'masyarakat',
                'password'      => bcrypt('masyarakat'),
                'level'         => 'masyarakat',
                'telp'          => '0814'
            ]
        ];
        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
