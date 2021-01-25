<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            'Guru/Dosen Peg. Negeri',
            'Peg. Negeri Bukan Guru',
            'TNI/Polisi',
            'Guru/Dosen Swasta',
            'Pegawai Swasta',
            'Wiraswasta',
            'Ahli Professional',
            'Petani',
            'Pensiunan',
            'Tidak Bekerja',
        ];

        foreach ($datas as $data) {
            DB::table('pekerjaan')->insert([
                'nama' => $data,
            ]);
        }
    }
}
