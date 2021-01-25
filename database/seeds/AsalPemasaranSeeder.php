<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsalPemasaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            'Surat Kerumah',
            'Spanduk',
            'Radio/Televisi',
            'Koran',
            'Teman',
            'Poster',
            'Lewat Kampus',
            'Pameran',
            'Presentasi di Sekolah',
            'Website/Internet',
        ];

        foreach ($datas as $data) {
            DB::table('asal_pemasaran')->insert([
                'nama' => $data,
            ]);
        }
    }
}
