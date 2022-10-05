<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('Asia/Kolkata');

        DB::table('roles')->insert([
            'r_id'=>'1',
            'role' => 'Admin',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]);

        DB::table('roles')->insert([
            'r_id'=>'2',
            'role' => 'Teacher',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]);

        DB::table('roles')->insert([
            'r_id'=>'3',
            'role' => 'Student',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]);

        //////////////////////

        // DB::table('mains')->insert([
        //     'name'=> 's1',
        //     'email'=> 's1@gmail.com',
        //     'address'=> '11',
        //     'current_school'=> 'abcd',
        //     'previous_school' => 'abcd',
        //     'r_id' => '3',
        //     'approval_status' => '0',
        //     'password' => bcrypt('password'),
        //     'created_at'=>date('Y-m-d H:i:s'),
        //     'updated_at'=>date('Y-m-d H:i:s')
        // ]);

        // DB::table('mains')->insert([
        //     'name'=> 's2',
        //     'email'=> 's2@gmail.com',
        //     'address'=> '11',
        //     'current_school'=> 'abcd',
        //     'previous_school' => 'abcd',
        //     'r_id' => '3',
        //     'approval_status' => '0',
        //     'password' => bcrypt('password'),
        //     'created_at'=>date('Y-m-d H:i:s'),
        //     'updated_at'=>date('Y-m-d H:i:s')
        // ]);

        // DB::table('mains')->insert([
        //     'name'=> 't1',
        //     'email'=> 't1@gmail.com',
        //     'address'=> '11',
        //     'current_school'=> 'abcd',
        //     'previous_school' => 'abcd',
        //     'r_id' => '2',
        //     'approval_status' => '0',
        //     'password' => bcrypt('password'),
        //     'created_at'=>date('Y-m-d H:i:s'),
        //     'updated_at'=>date('Y-m-d H:i:s')
        // ]);

        // DB::table('mains')->insert([
        //     'name'=> 't2',
        //     'email'=> 't2@gmail.com',
        //     'address'=> '11',
        //     'current_school'=> 'abcd',
        //     'previous_school' => 'abcd',
        //     'r_id' => '2',
        //     'approval_status' => '0',
        //     'password' => bcrypt('password'),
        //     'created_at'=>date('Y-m-d H:i:s'),
        //     'updated_at'=>date('Y-m-d H:i:s')
        // ]);

        // DB::table('mains')->insert([
        //     'name'=> 'a1',
        //     'email'=> 'a1@gmail.com',
        //     'address'=> '11',
        //     'current_school'=> 'abcd',
        //     'previous_school' => 'abcd',
        //     'r_id' => '1',
        //     'approval_status' => '0',
        //     'password' => bcrypt('password'),
        //     'created_at'=>date('Y-m-d H:i:s'),
        //     'updated_at'=>date('Y-m-d H:i:s')
        // ]);

        // DB::table('mains')->insert([
        //     'name'=> 'a2',
        //     'email'=> 'a2@gmail.com',
        //     'address'=> '11',
        //     'current_school'=> 'abcd',
        //     'previous_school' => 'abcd',
        //     'r_id' => '1',
        //     'approval_status' => '0',
        //     'password' => bcrypt('password'),
        //     'created_at'=>date('Y-m-d H:i:s'),
        //     'updated_at'=>date('Y-m-d H:i:s')
        // ]);
    }
}