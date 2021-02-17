<?php

return [
    '_' => 'Sertifikasi',
    'fields' => [
        'semester_id' => 'Semester',
        'nama' => 'Nama Sertifikasi',
        'lembaga' => 'Lembaga',
        'nilai' => 'Nilai',
        'catatan' => 'Catatan',
        'file_upload' => 'Bukti Sertifikasi',
    ],
    'placeholders' => [
        'semester_id' => 'Pilih semester',
        'nama' => 'Masukkan nama sertifikasi',
        'lembaga' => 'Masukkan nama lembaga',
        'nilai' => 'Masukkan nilai (tidak wajib)',
        'catatan' => 'Masukkan catatan sertifikasi (tidak wajib)',
        'file_upload' => 'Upload bukti sertifikasi',
    ],
    'messages' => [
        'success' => [
            'create' => 'Sertifikasi berhasil ditambahkan.',
            'update' => 'Sertifikasi berhasil diubah.',
            'delete' => 'Sertifikasi berhasil dihapus.'
        ],
        'errors' => [
            'create' => 'Gagal menambahkan sertifikasi.',
            'update' => 'Gagal merubah sertifikasi.',
            'delete' => 'Gagal menghapus sertifikasi.',
            'not_found' => 'Sertifikasi tidak ditemukan.',
            'exists' => 'Sertifikasi sudah pernah dibuat',
        ],
    ]
];
