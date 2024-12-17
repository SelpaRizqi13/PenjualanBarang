@extends('layouts.auth')

@section('content')
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 d-flex flex-column mx-lg-0 mx-auto">
                            <div>
                                <div class="card-header pb-0 text-start">
                                    @error('error')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <h1 class="font-weight-bolder">Sign In</h1>
                                    <p class="mb-4">Enter your username and password to sign in</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" action="/login" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="email" name="email" value="{{ old('email') }}" id="email"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                placeholder="Email" aria-label="Email" required>
                                            @error('email')
                                                <div class="invalid-feedback mb-3" style="display: block;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" name="password" id="password"
                                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                placeholder="Password" aria-label="Password" required>
                                            @error('password')
                                                <div class="invalid-feedback mb-3" style="display: block;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-2 mb-0">Sign
                                                in</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Don't have an account?
                                        <a href="javascript:;" class="text-primary text-gradient font-weight-bold">Sign
                                            up</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('{{ asset('image/halaman_login.png') }}'); 
                                       background-size: contain; 
                                       background-position: center; 
                                       background-repeat: no-repeat;">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
