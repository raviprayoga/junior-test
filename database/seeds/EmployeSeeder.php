<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'first_name' => "budi",
            'last_name' => "doremi",
            'company_id' => "1",
            'email' => "budi@gmail.com",
            'phone' => "089988",
            'password' => bcrypt("asd"),
            'created_by_id' => 1,
            'updated_by_id' =>2,
        ]);
    }
}
