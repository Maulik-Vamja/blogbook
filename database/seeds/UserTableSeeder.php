<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'Maulik Vamja',
            'username' => 'maulik_vamja',
            'email' => 'maulikvamja1@gmail.com',
            'about' => 'I am Maulik Vamja. Professionally i am a Laravel Backend Developer. In future i become a Javascipt Devloper.',
            'password' => bcrypt('admin123'),
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'Harshil Vastarpara',
            'username' => 'harshil_vastarpra',
            'email' => 'harshil@gmail.com',
            'about' => 'I am Harshil Vastarpara. Professionally i am a Graphics Designer. In future i become a Javascipt Devloper.',
            'password' => bcrypt('admin123'),
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'Nikunj Thesiya',
            'username' => 'nikunj_thesiya',
            'email' => 'nikunj@gmail.com',
            'about' => 'I am Nikunj Thesiya. Professionally i am a Frontend Designer. In future i become a Javascipt Devloper.',
            'password' => bcrypt('admin123'),
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'Sachin Sheladiya',
            'username' => 'sachin_sheladiya',
            'email' => 'sachin@gmail.com',
            'about' => 'I am Sachin Sheladiya. Professionally i am a Laravel Backend Developer. In future i become a Javascipt Devloper.',
            'password' => bcrypt('admin123'),
            'created_at' => Carbon::now(),
        ]);
    }
}
