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
                'name'          => 'admin',
                'username'      => 'admin',
                'password'      => bcrypt('admin'),
                'passwordshow'  =>'admin',
                'level'         => 'admin',
                'telp'          => '081212122121'
            ],
            [
                'name'          => 'petugas',
                'username'      => 'petugas',
                'password'      => bcrypt('petugas'),
                'passwordshow'  => 'petugas',
                'level'         => 'petugas',
                'telp'          => '081313133131'
            ],
            [
                'name'          => 'masyarakat',
                'username'      => 'masyarakat',
                'password'      => bcrypt('masyarakat'),
                'passwordshow'  => 'masyarakat',
                'level'         => 'masyarakat',
                'telp'          => '081414144141'
            ]
        ];
        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
