<?php

use Illuminate\Database\Seeder;

class ProfilAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profil_admin')->insert([
            'admin_id' => 1,
            'nama' => 'admin',
        ]);
    }
}
