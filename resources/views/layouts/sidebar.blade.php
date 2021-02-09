<ul class="c-sidebar-nav">
    @auth('admin')
    {{-- Main Menu --}}
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.home') }}">
        <i class="cil-speedometer c-sidebar-nav-icon"></i> Dashboard</a>
    </li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-people c-sidebar-nav-icon"></i> Mahasiswa</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a href="{{ route('admin.mahasiswa.index') }}" class="c-sidebar-nav-link">
                Daftar Mahasiswa</a>
            </li>
            <li class="c-sidebar-nav-item"><a href="{{ route('admin.mahasiswa.create') }}" class="c-sidebar-nav-link">
                Tambah Mahasiswa</a>
            </li>
        </ul>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.jurusan.index') }}">
        <i class="cil-bookmark c-sidebar-nav-icon"></i> Jurusan</a>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.tahun_akademik.index') }}">
        <i class="cil-institution c-sidebar-nav-icon"></i> Tahun Akademik</a>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.ekstrakurikuler.index') }}">
        <i class="cil-basketball c-sidebar-nav-icon"></i> Ekstrakurikuler</a>
    </li>
    {{-- Data Master --}}
    <li class="c-sidebar-nav-title">Data Master</li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-map c-sidebar-nav-icon"></i> Wilayah</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a href="{{ route('admin.provinsi.index') }}" class="c-sidebar-nav-link">
                Provinsi</a>
            </li>
            <li class="c-sidebar-nav-item"><a href="{{ route('admin.kabkota.index') }}" class="c-sidebar-nav-link">
                Kabupaten/Kota</a>
            </li>
            <li class="c-sidebar-nav-item"><a href="{{ route('admin.kecamatan.index') }}" class="c-sidebar-nav-link">
                Kecamatan</a>
            </li>
            <li class="c-sidebar-nav-item"><a href="{{ route('admin.desa.index') }}" class="c-sidebar-nav-link">
                Kelurahan/Desa</a>
            </li>
        </ul>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.pekerjaan.index') }}">
        <i class="cil-watch c-sidebar-nav-icon"></i> Pekerjaan</a>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.asal_pemasaran.index') }}">
        <i class="cil-chart-line c-sidebar-nav-icon"></i> Asal Pemasaran</a>
    </li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-settings c-sidebar-nav-icon"></i> Pengaturan</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#">
                Ganti Password</a>
            </li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#">
                Pengaturan Profil</a>
            </li>
        </ul>
    </li>
    @else
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('home') }}">
        <i class="cil-speedometer c-sidebar-nav-icon"></i> Dashboard</a>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('mahasiswa') }}">
        <i class="cil-user c-sidebar-nav-icon"></i> Profil Mahasiswa</a>
    </li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-institution c-sidebar-nav-icon"></i> Semester</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('semester.index') }}">
                Daftar Semester</a>
            </li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('semester.create') }}">
                Tambah Semester</a>
            </li>
        </ul>
    </li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-task c-sidebar-nav-icon"></i> KRS</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('krs.index') }}">
                Daftar KRS</a>
            </li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('krs.create') }}">
                Tambah KRS</a>
            </li>
        </ul>
    </li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-basketball c-sidebar-nav-icon"></i> Ekstrakurikuler</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#">
                Daftar Ekstrakurikuler</a>
            </li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#">
                Tambah Ekstrakurikuler</a>
            </li>
        </ul>
    </li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-school c-sidebar-nav-icon"></i> Sertifikasi</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#">
                Daftar Sertifikasi</a>
            </li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#">
                Tambah Sertifikasi</a>
            </li>
        </ul>
    </li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-calendar c-sidebar-nav-icon"></i> Kegiatan</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#">
                Daftar Kegiatan</a>
            </li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#">
                Tambah Kegiatan</a>
            </li>
        </ul>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('ganti_password') }}">
        <i class="cil-settings c-sidebar-nav-icon"></i> Ganti Password</a>
    </li>
    @endauth
</ul>
