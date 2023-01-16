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
            'name' => '11111111111',
            'phone' => 1111111,
            'age' => 31,
            'password' => 'kakakulopedopis',
            'email' => '111111111111rrr00@gmail.com',
            'sex' => 'Dinosaur',
            'teacher_id'=>'2'
        ]);
        DB::table('students')->insert([
            'name' => '22222222',
            'phone' => 222222,
            'age' => 35,
            'password' => 'asfasnfjas',
            'email' => '22222222rr2200@gmail.com',
            'sex' => 'Alien',
            'teacher_id'=>'1'
        ]);
        DB::table('students')->insert([
            'name' => '333333333',
            'phone' => 3333333,
            'age' => 31,
            'password' => 'kakakulopedopis',
            'email' => '333333333303300@gmail.com',
            'sex' => 'Dinosaur',
            'teacher_id'=>'2',
        ]);
        DB::table('students')->insert([
            'name' => '44444444444',
            'phone' => 444444,
            'age' => 35,
            'password' => 'asfasnfjas000',
            'email' => '6465313441000@gmail.com',
            'sex' => 'Alien',
            'teacher_id'=>'3'
        ]);

    }
}