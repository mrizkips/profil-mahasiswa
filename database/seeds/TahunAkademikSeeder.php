<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahunAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tahun_akademik')->insert([
            ['nama' => '2018/2019'],
            ['nama' => '2019/2020'],
            ['nama' => '2020/2021'],
        ]);
    }
}
