<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            'name' => 'Miguel',
                'teacherCode' => '5259j8rtjndgj98',
                'email' => 'miguel@gmail.com',
                'password' => 'kkkk1',
        ]);
        DB::table('teachers')->insert([
            'name' => 'Alejandro',
                'teacherCode' => '5259j8rtjndgj98',
                'email' => 'alejandro@gmail.com',
                'password' => 'kkkk2',
        ]);
        DB::table('teachers')->insert([
            'name' => 'Adrian',
                'teacherCode' => 'd6f554ga1df3h',
                'email' => 'adrian@gmail.com',
                'password' => 'kkkk3',
        ]);
    }
}
