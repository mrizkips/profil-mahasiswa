<?php

namespace App\Services;

use App\Models\Semester;
use App\Traits\Uploadable;
use Exception;
use Illuminate\Support\Facades\DB;

class SemesterService
{
    use Uploadable;

    /**
     * Hapus semester dan menghapus file upload.
     *
     * @param \App\Models\Semester $semester
     * @return bool
     */
    public function delete(Semester $semester)
    {
        DB::beginTransaction();
        try {
            $krs = $semester->krs;
            throw_unless($this->deleteFile($krs->file_upload), new Exception());

            $sertifikasi = $semester->sertifikasi;
            foreach ($sertifikasi as $item) {
                throw_unless($this->deleteFile($item->file_upload), new Exception());
            }

            $kegiatan = $semester->kegiatan;
            foreach ($kegiatan as $item) {
                throw_unless($this->deleteFile($item->file_upload), new Exception());
            }

            $deleted = $semester->delete();
            DB::commit();
        } catch (Exception $e) {
            $deleted = false;
            DB::rollBack();
        }

        return $deleted;
    }
}
