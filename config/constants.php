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
    'register' => [
        'true' => '1',
        'false' => '0',
    ],
    'forms' => [
        'jen_kel' => [
            'lakilaki' => 'l',
            'perempuan' => 'p',
        ],
        'mahasiswa' => [
            'status_mhs' => [
                'baru' => 1,
                'pindahan' => 2,
            ]
        ]
    ]
];
