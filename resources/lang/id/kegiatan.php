<?php

return [
    '_' => 'Kegiatan',
    'fields' => [
        'semester_id' => 'Semester',
        'nama' => 'Nama Kegiatan',
        'penyelenggara' => 'Lembaga',
        'tingkat' => 'Tingkat',
        'file_upload' => 'Bukti Kegiatan',
    ],
    'placeholders' => [
        'semester_id' => 'Pilih semester',
        'nama' => 'Masukkan nama kegiatan',
        'penyelenggara' => 'Masukkan nama penyelenggara',
        'tingkat' => 'Pilih tingkat',
        'file_upload' => 'Upload bukti kegiatan',
    ],
    'messages' => [
        'success' => [
            'create' => 'Kegiatan berhasil ditambahkan.',
            'update' => 'Kegiatan berhasil diubah.',
            'delete' => 'Kegiatan berhasil dihapus.'
        ],
        'errors' => [
            'create' => 'Gagal menambahkan kegiatan.',
            'update' => 'Gagal merubah kegiatan.',
            'delete' => 'Gagal menghapus kegiatan.',
            'not_found' => 'Kegiatan tidak ditemukan.',
            'exists' => 'Kegiatan sudah pernah dibuat',
        ],
    ]
];
