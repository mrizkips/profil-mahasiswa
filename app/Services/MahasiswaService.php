<?php

namespace App\Services;

use App\Models\Mahasiswa;
use Exception;
use Illuminate\Support\Facades\DB;

class MahasiswaService
{
    public function create(array $fields)
    {
        DB::beginTransaction();
        try {
            $mahasiswa = new Mahasiswa();
            $mahasiswa->fill($fields);
            throw_unless($mahasiswa->save(), new Exception());

            $mahasiswa->profil_mhs()->create($fields);
            $created = $mahasiswa->fresh();
            DB::commit();
        } catch (Exception $e) {
            $created = false;
            DB::rollBack();
        }

        return $created;
    }

    public function update(Mahasiswa $mahasiswa, array $fields = [], array $profile_fields = [])
    {
        DB::beginTransaction();
        try {
            $mahasiswa->fill($fields);
            throw_unless($mahasiswa->update(), new Exception());
            $mahasiswa->profil_mhs()->update($profile_fields);
            $updated = $mahasiswa->fresh();
            DB::commit();
        } catch (Exception $e) {
            $updated = false;
            DB::rollBack();
        }

        return $updated;
    }
}
