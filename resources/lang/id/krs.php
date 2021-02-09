<?php

return [
    '_' => 'KRS',
    'fields' => [
        'semester_id' => 'Semester',
        'jumlah' => 'Jumlah SKS',
        'catatan' => 'Catatan',
        'file_upload' => 'Bukti KRS',
    ],
    'placeholders' => [
        'semester_id' => 'Pilih semester',
        'jumlah' => 'Masukkan jumlah SKS',
        'catatan' => 'Masukkan catatan KRS (tidak wajib)',
        'file_upload' => 'Upload bukti KRS',
    ],
    'messages' => [
        'success' => [
            'create' => 'KRS berhasil ditambahkan.',
            'update' => 'KRS berhasil diubah.',
            'delete' => 'KRS berhasil dihapus.'
        ],
        'errors' => [
            'create' => 'Gagal menambahkan KRS.',
            'update' => 'Gagal merubah KRS.',
            'delete' => 'Gagal menghapus KRS.',
            'not_found' => 'KRS tidak ditemukan.',
            'exists' => 'KRS sudah pernah dibuat',
        ],
    ]
];
