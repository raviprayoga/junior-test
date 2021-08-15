<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => "PT.Tunas",
            'email' => 'tunas@gmail.com',
            'logo' => Str::random(10).'.jpg',
            'created_by_id' => 1,
            'updated_by_id' => 1,
        ]);
    }
}
