<?php

return [
    '_' => 'Mahasiswa',
    'fields' => [
        'nama' => 'Nama Lengkap',
        'username' => 'Nama Pengguna',
        'jen_kel' => 'Jenis Kelamin',
        'alamat' => 'Alamat',
        'provinsi_id' => 'Provinsi',
        'kabkota_id' => 'Kabupaten/Kota',
        'kecamatan_id' => 'Kecamatan',
        'desa_id' => 'Desa',
        'kode_pos' => 'Kode Pos',
        'rt' => 'RT',
        'rw' => 'RW',
        'kabkota_lahir_id' => 'Kab/Kota Lahir',
        'tgl_lahir' => 'Tanggal Lahir',
        'telp' => 'Nomor Telepon',
        'no_hp' => 'Nomor HP',
        'kontak_lain' => 'Kontak Lain',
        'pas_foto' => 'Pas Foto',
    ],
    'placeholders' => [
        'nama' => 'Masukkan nama lengkap',
        'username' => 'Masukkan nama pengguna',
        'alamat' => 'Masukkan alamat',
        'provinsi_id' => 'Pilih provinsi',
        'kabkota_id' => 'Pilih kabupaten/kota',
        'kecamatan_id' => 'Pilih Kecamatan',
        'desa_id' => 'Pilih desa',
        'kode_pos' => 'Masukkan kode pos',
        'rt' => 'Masukkan RT',
        'rw' => 'Masukkan RW',
        'kabkota_lahir_id' => 'Pilih kab/kota lahir',
        'tgl_lahir' => 'Masukkan tanggal lahir',
        'telp' => 'Masukkan no. telepon',
        'no_hp' => 'Masukkan no. HP',
        'kontak_lain' => 'Masukkan kontak lain',
        'email' => 'Masukkan alamat e-mail',
        'website' => 'Masukkan alamat website',
        'pas_foto' => 'Unggah pas foto',
    ],
    'messages' => [
        'success' => [
            'create' => 'Admin berhasil ditambahkan.',
            'update' => 'Admin berhasil diubah.',
            'delete' => 'Admin berhasil dihapus.'
        ],
        'errors' => [
            'create' => 'Gagal menambahkan admin.',
            'update' => 'Gagal merubah admin.',
            'delete' => 'Gagal menghapus admin.',
            'not_found' => 'Admin tidak ditemukan.',
        ],
    ]
];
