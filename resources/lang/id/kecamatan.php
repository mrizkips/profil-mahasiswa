<?php

return [
    '_' => 'Kecamatan',
    'fields' => [
        'nama' => 'Nama Kecamatan',
        'kabkota_id' => 'Kabupaten/Kota'
    ],
    'placeholders' => [
        'nama' => 'Masukkan nama kecamatan',
        'kabkota_id' => 'Pilih Kabupaten/Kota'
    ],
    'messages' => [
        'success' => [
            'create' => 'Kecamatan berhasil ditambahkan.',
            'update' => 'Kecamatan berhasil diubah.',
            'delete' => 'Kecamatan berhasil dihapus.'
        ],
        'errors' => [
            'create' => 'Gagal menambahkan kecamatan.',
            'update' => 'Gagal merubah kecamatan.',
            'delete' => 'Gagal menghapus kecamatan.',
            'not_found' => 'Kecamatan tidak ditemukan.',
        ],
    ]
];
