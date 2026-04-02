<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
        <li class="nav-small-cap">
            <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
            <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('admin.index') }}" aria-expanded="false">
                <i class="ti ti-atom"></i>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>

        @if(Auth::check() && Auth::user()->role === 'admin')
            <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" href="{{ route('admin.orangtua.index') }}" aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                        <i class="ti ti-notes"></i>
                        <span class="hide-menu">Akun OrangTua</span>
                    </div>
                </a>
            </li>


            <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" href="{{ route('admin.siswa.index') }}" aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                        <i class="ti ti-notes"></i>
                        <span class="hide-menu">Akun Siswa</span>
                    </div>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" href="{{ route('admin.pengaduansaran.index') }}" aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                        <i class="ti ti-notes"></i>
                        <span class="hide-menu">Pengaduan</span>
                    </div>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link justify-content-between" href="{{ route('admin.tanggapan.index') }}" aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                        <i class="ti ti-notes"></i>
                        <span class="hide-menu">Tanggapan</span>
                    </div>
                </a>
            </li>
        @endif
    </ul>
</nav>