<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            'name_teacher' => 'JAIRO SOUSA',
            'email' => 'teste@teste.com',
            'password' => Hash::make('123'),
        ]);
    }
}
