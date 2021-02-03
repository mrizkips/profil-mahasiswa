<ul class="c-sidebar-nav">
    @auth('admin')
    {{-- Main Menu --}}
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.home') }}">
        <i class="cil-speedometer c-sidebar-nav-icon"></i> Dashboard</a>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.mahasiswa.index') }}">
        <i class="cil-people c-sidebar-nav-icon"></i> Mahasiswa</a>
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
    @endauth
    @auth('mahasiswa')
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('home') }}">
        <i class="cil-speedometer c-sidebar-nav-icon"></i> Dashboard</a>
    </li>
    @endauth
</ul>
