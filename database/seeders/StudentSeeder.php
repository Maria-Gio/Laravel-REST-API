<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'name' => 'Akuma',
            'phone' => 69696969,
            'age' => 31,
            'password' => 'kakakulopedopis',
            'email' => 'emaildekkkkkkkkkkkkkkk@gmail.com',
            'sex' => 'Dinosaur'
        ]);
        DB::table('students')->insert([
            'name' => 'La Gio',
            'phone' => 9696969,
            'age' => 35,
            'password' => 'asfasnfjas',
            'email' => 'emaildekksss@gmail.com',
            'sex' => 'Alien'
        ]);
    }
}