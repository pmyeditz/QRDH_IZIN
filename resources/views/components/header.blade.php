<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <span class="d-none d-lg-block">E-QRDH</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <!-- Navigasi Header -->
  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <!-- Icon Pencarian (hanya muncul di tampilan kecil) -->
      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
          <i class="bi bi-search"></i>
        </a>
      </li><!-- End Icon Pencarian -->

      <!-- Dropdown Profil -->
      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <span class="d-none d-md-block dropdown-toggle ps-2">
            @auth
                {{ auth()->user()->nama }}
            @endauth
        </span>
        </a><!-- End Icon Profil -->

        <!-- Daftar Profil Dropdown -->
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>
                @auth
                    {{ auth()->user()->nama }}
                @endauth
            </h6>
            <span>
                @auth
                    @php
                        $roleName = auth()->user()->role->nama;
                    @endphp
                    {{ $roleName }}
                @endauth
            </span>
          </li>
          <li><hr class="dropdown-divider"></li>

          <!-- Tautan Profil -->
          <li>
            <a class="dropdown-item d-flex align-items-center" href="/profile">
              <i class="bi bi-person"></i>
              <span>Profil Saya</span>
            </a>
          </li>
          <li><hr class="dropdown-divider"></li>


          <li>
            <a class="dropdown-item d-flex align-items-center" href="/logout">
              <i class="bi bi-box-arrow-right"></i>
              <span>Keluar</span>
            </a>
          </li>
        </ul><!-- End Daftar Profil Dropdown -->
      </li><!-- End Dropdown Profil -->

    </ul>
  </nav><!-- End Navigasi Ikons -->

</header><!-- End Header -->
