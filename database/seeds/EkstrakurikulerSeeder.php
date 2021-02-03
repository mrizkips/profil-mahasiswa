<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EkstrakurikulerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ekstrakurikuler')->insert([
            ['nama' => 'HIMA'],
        ]);
    }
}
