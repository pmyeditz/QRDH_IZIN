<x-layout>
@section('main')
<x-header></x-header>
<x-sidebar></x-sidebar>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Profil</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">dashboard</a></li>
          <li class="breadcrumb-item">Pengguna</li>
          <li class="breadcrumb-item active">Profil</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->



    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <h2>
                    @if ($user)
                    <p>{{ $user->nama }}</p>
                    @else
                        <p>Tidak ada pengguna yang login.</p>
                    @endif
                </h2>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Tab Bordered -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Ikhtisar</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profil</button>
                </li>

              </ul>
              <div class="tab-content pt-2">
                  <div class="tab-pane fade show active profile-overview" id="profile-overview">

                      <h5 class="card-title">Detail Profil</h5>
                        @error('current_password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      <!-- salah -->
                        @if(session('error'))
                            <div class="alert alert-danger alert-sm">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- benar -->
                        @if(session('success'))
                            <div class="alert alert-success alert-sm">
                                {{ session('success') }}
                            </div>
                        @endif
                    @if ($user)
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Nama </div>
                        <div class="col-lg-9 col-md-8">: {{ $user->nama }}</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Username</div>
                      <div class="col-lg-9 col-md-8">: {{ $user->username }}</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Status</div>
                      <div class="col-lg-9 col-md-8">: {{ $user->role->nama }}</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">No Hp</div>
                      <div class="col-lg-9 col-md-8">: {{ $user->no_hp }}</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Nip</div>
                      <div class="col-lg-9 col-md-8">: {{ $user->nip }}</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Alamat</div>
                      <div class="col-lg-9 col-md-8">: {{ $user->alamat }}</div>
                    </div>
                    @else
                        <p>Tidak ada pengguna yang login.</p>
                    @endif

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Form Edit Profil -->
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="nama" type="text" class="form-control" id="fullName" value="{{ $user->nama }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="username" type="text" class="form-control" id="username" value="{{ $user->username }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="alamat" type="text" class="form-control" id="alamat" value="{{ $user->alamat }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="noHp" class="col-md-4 col-lg-3 col-form-label">No Hp</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="no_hp" type="text" class="form-control" id="noHp" value="{{ $user->no_hp }}">
                        </div>
                    </div>


                    @php
                        $role = Auth::user()->role->nama;
                    @endphp
                    @if($role == 'guru' || $role == 'pengurus')
                    <div class="row mb-3">
                        <label for="status" class="col-md-4 col-lg-3 col-form-label">Status</label>
                        <div class="col-md-8 col-lg-9">
                            <select class="form-control" name="role_id" id="role_id" disabled>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $role->id == Auth::user()->role_id ? 'selected' : '' }}>
                                        {{ $role->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="role_id" value="{{ Auth::user()->role_id }}">
                        </div>
                    </div>
                    @endif
                    @if($role == 'admin')
                    <div class="row mb-3">
                        <label for="status" class="col-md-4 col-lg-3 col-form-label">Status</label>
                        <div class="col-md-8 col-lg-9">
                            <select class="form-control" name="role_id" id="role_id">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    <!-- Input untuk kata sandi saat ini -->
                    <div class="row mb-3">
                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Kata Sandi Saat Ini</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="current_password" type="password" class="form-control" id="currentPassword">
                            @error('current_password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Input untuk kata sandi baru -->
                    <div class="row mb-3">
                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Kata Sandi Baru</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="new_password" type="password" class="form-control" id="newPassword">
                        </div>
                    </div>

                    <!-- Input untuk konfirmasi kata sandi baru -->
                    <div class="row mb-3">
                        <label for="confirmPassword" class="col-md-4 col-lg-3 col-form-label">Konfirmasi Kata Sandi Baru</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="new_password_confirmation" type="password" class="form-control" id="confirmPassword">
                        </div>
                    </div>

                    <!-- Tombol untuk menyimpan perubahan -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form><!-- End Form Edit Profil -->

                </div>

              </div><!-- End Tab Bordered -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
    @endsection
</x-layout>
