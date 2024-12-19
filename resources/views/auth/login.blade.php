<x-layout>
@section('login')
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="assets/img/logo.png" alt="">
                                <span class="d-none d-lg-block">QRDH</span>
                            </a>
                        </div>
                        </div>
                        <form action="" method="post" class="row g-3 needs-validation">
                            @csrf
                            <div class="col-12">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group has-validation">
                                    <input type="text" name="username" class="form-control" id="username" required>
                                    <div class="invalid-feedback">Please enter  username.</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="Password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="Password" required>
                                <div class="invalid-feedback">Please enter  password!</div>
                            </div>
                            @if (session('gagal'))
                            <div class="col-12">
                                <div class="alert alert-danger text-center">{{ session('gagal') }}</div>
                            </div>
                            @endif
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Login</button>
                            </div>
                        </form>
                        <div class="credits text-center">
                            Design <a href="">Ridho</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
</x-layout>
