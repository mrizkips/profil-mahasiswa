<?php

namespace App\Services;

use App\Models\Admin;
use Exception;
use Illuminate\Support\Facades\DB;

class AdminService
{
    public function create(array $fields)
    {
        DB::beginTransaction();
        try {
            $admin = new Admin();
            $admin->fill($fields);
            throw_unless($admin->save(), new Exception());

            $admin->profil_admin->create($fields);
            $created = $admin->fresh();
            DB::commit();
        } catch (Exception $e) {
            $created = false;
            DB::rollBack();
        }

        return $created;
    }

    public function update(Admin $admin, array $fields = [], array $profile_fields = [])
    {
        DB::beginTransaction();
        try {
            $admin->fill($fields);
            throw_unless($admin->update(), new Exception());
            $admin->profil_admin->update($profile_fields);
            $updated = $admin->fresh();
            DB::commit();
        } catch (Exception $e) {
            $updated = false;
            DB::rollBack();
        }

        return $updated;
    }
}
