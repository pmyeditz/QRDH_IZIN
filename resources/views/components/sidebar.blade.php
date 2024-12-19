@php
    $role_name = Auth::user()->role->nama;
@endphp
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <!-- Dashboard Nav -->
        <li class="nav-item">
            <a class="nav-link" href="/dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        @if($role_name == 'admin' || $role_name == 'pengurus')
        <li class="menu-header">
            <span>SANTRI</span>
        </li><!-- End santri -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-toggle="collapse" href="#forms-santri">
                <i class="bi bi-people"></i>
                <span>Data Santri</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-santri" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li><a href="/santri"><i class="bi bi-circle"></i><span>Santri</span></a></li>
                <li><a href="/kelas"><i class="bi bi-circle"></i><span>Kelas</span></a></li>
                {{-- <li><a href="/jurusan"><i class="bi bi-circle"></i><span>Jurusan</span></a></li> --}}
            </ul>
        </li><!-- End data santri -->
        @endif

        @if($role_name == 'admin')
        {{-- <li class="menu-header">
            <span>GURU</span>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="/guru">
                <i class='bi bi-person-gear'></i>
                <span>Guru</span>
            </a>
        </li> --}}
        @endif<!-- End guru -->

        @if($role_name == 'admin' || $role_name == 'pengurus')
        <li class="menu-header">
            <span>PERIZINAN</span>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-toggle="collapse" href="#forms-izin">
                <i class="bi bi-card-list"></i>
                <span>Perizinan</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-izin" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li><a href="/izin"><i class="bi bi-circle"></i><span>Izin</span></a></li>
                <li><a href="/scanner"><i class="bi bi-circle"></i><span>Scan QR</span></a></li>
            </ul>
        </li>
        @endif<!-- End perizinan -->

        @if($role_name == 'admin' || $role_name == 'pengurus')
        <li class="nav-item">
            <a class="nav-link collapsed" href="/card">
                <i class="bi bi-person-vcard"></i>
                <span>Membuat Qr</span>
            </a>
        </li>
        @endif<!-- End Card -->

        @if($role_name == 'admin' || $role_name == 'pengurus' || $role_name == 'guru')
        <li class="nav-item">
            <a class="nav-link collapsed" href="/logizin">
                <i class="bi bi-clock-history"></i>
                <span>Laporan Perizinan</span>
            </a>
        </li>
        @endif<!-- End Log Perizinan -->

        @if($role_name == 'admin')
        <li class="menu-header">
            <span>USER</span>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="/user">
                <i class='bi bi-person-gear'></i>
                <span>Data Pengguna</span>
            </a>
        </li>
        @endif<!-- End User -->

        <hr>
        <li class="menu-header">
            <span>LOG OUT</span>
        </li>
        <li class="nav-item" style="margin-buttom:0;">
            <a href="/logout" class="nav-link collapsed">
                <i class="bi bi-box-arrow-left"></i>
                <span>Log out</span>
            </a>
        </li>
    </ul>
</aside>
