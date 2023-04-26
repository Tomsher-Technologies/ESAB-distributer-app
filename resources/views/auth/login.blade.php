@extends('admin.layouts.auth', ['body_class' => 'login_page'])

@section('content')
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="dashboard.html" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ adminAsset('img/logo_m.png') }}" width="150" alt="">
                                </a>
                            </div><!-- End Logo -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        <p class="text-center small">Enter your username & password to login</p>
                                    </div>
                                    <form class="row g-3 needs-validation" method="POST" action="{{ route('login') }}"
                                        novalidate>
                                        @csrf

                                        @error('login')
                                            <div class="alert alert-danger m-0">{{ $message }}</div>
                                        @enderror

                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <input autofocus type="email" autocomplete="email" name="email"
                                                    value="test@test.com" value="{{ old('email') }}" class="form-control"
                                                    id="email" required>
                                                <div class="invalid-feedback">Please enter your email.</div>
                                            </div>
                                            @error('email')
                                                <div class="alert alert-danger mb-0 mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" value="password"
                                                id="password" required>
                                            @error('password')
                                                <div class="alert alert-danger mb-0 mt-1">{{ $message }}</div>
                                            @enderror
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember_me"
                                                    value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-100 p-3">Login</button>
                                            {{-- <a class="btn btn-primary w-100" href="dashboard.html">Login</a> --}}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
