<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mothers')->insert([
            'name' => 'Manuela',
            'phone' => '66885533',
            'age' => '34',
            'email' => 'madre1@gmail.com',
            'student_id'=>'4'
        ]);
        DB::table('mothers')->insert([
            'name' => 'Cristina',
            'phone' => '668654133',
            'age' => '44',
            'email' => 'madre2@gmail.com',
            'student_id'=>'5'
        ]);
        DB::table('mothers')->insert([
            'name' => 'Godofreda',
            'phone' => '6548651320',
            'age' => '69',
            'email' => 'madre3@gmail.com',
            'student_id'=>'6'
        ]);



    }
}