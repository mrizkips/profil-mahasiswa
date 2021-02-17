<?php

return [
    'guards' => [
        'admin' => [
            'guard' => 'admin',
            'provider' => 'admin',
            'model' => App\Models\Admin::class,
        ],
        'mahasiswa' => [
            'guard' => 'mahasiswa',
            'provider' => 'mahasiswa',
            'model' => App\Models\Mahasiswa::class,
        ],
    ],
    'is_register' => [
        'true' => '1',
        'false' => '0',
    ],
    'tahun_akademik' => [
        'aktif' => '1',
        'nonaktif' => '0',
    ],
    'forms' => [
        'jen_kel' => [
            'l' => 'Laki-laki',
            'p' => 'Perempuan',
        ],
        'mahasiswa' => [
            'status_mhs' => [
                'baru' => 'Baru',
                'pindahan' => 'Pindahan',
            ]
        ],
        'semester' => [
            'Genap', 'Ganjil', 'Antara',
        ],
        'jabatan' => [
            'Anggota', 'Sekretaris', 'Ketua', 'Wakil Ketua',
        ],
        'tingkat' => [
            'Lokal', 'Nasional', 'Internasional',
        ],
    ],
];
