<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jurusan')->insert([
            ['nama' => 'Teknik Informatika'],
            ['nama' => 'Sistem Informasi'],
        ]);
    }
}
