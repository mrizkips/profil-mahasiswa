<?php

use App\Models\TahunAkademik;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Wilayah
        $this->call(ProvinsiSeeder::class);
        $this->call(KabKotaSeeder::class);
        $this->call(KecamatanSeeder::class);
        $this->call(DaerahSeeder::class);

        // Data Master
        $this->call(JurusanSeeder::class);
        $this->call(TahunAkademikSeeder::class);
        $this->call(EkstrakurikulerSeeder::class);
        $this->call(PekerjaanSeeder::class);
        $this->call(AsalPemasaranSeeder::class);

        // User
        $this->call(AdminSeeder::class);
        $this->call(ProfilAdminSeeder::class);
    }
}
