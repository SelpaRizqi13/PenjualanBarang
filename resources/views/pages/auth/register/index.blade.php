@extends('layouts.auth')

@section('content')
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col-md-7 p-4 mb-0">
                            @if (session()->has('loginError'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('loginError') }}
                                    <button class="btn-close" type="button" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="card-body">
                                <h1>Register</h1>
                                <p class="text-medium-emphasis">Register In to your account</p>
                                <form action="/register" method="POST">
                                    @csrf
                                    <div class="input-group mb-3"><span class="input-group-text">
                                            <svg class="icon">
                                                <use
                                                    xlink:href="{{ asset('coreui/assets/@coreui/icons/svg/free.svg#cil-user') }}">
                                                </use>
                                            </svg></span>
                                        <input class="form-control @error('name') is-invalid @enderror" name="name"
                                            id="name" type="name" placeholder="name" required value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>

                                        @enderror
                                    </div>
                                    <div class="input-group mb-3"><span class="input-group-text">
                                            <svg class="icon">
                                                <use
                                                    xlink:href="{{ asset('coreui/assets/@coreui/icons/svg/free.svg#cil-user') }}">
                                                </use>
                                            </svg></span>
                                        <input class="form-control @error('email') is-invalid @enderror" name="email"
                                            id="email" type="email" placeholder="Email" required
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>

                                        @enderror
                                    </div>
                                    <div class="input-group mb-4"><span class="input-group-text">
                                            <svg class="icon">
                                                <use
                                                    xlink:href="{{ asset('coreui/assets/@coreui/icons/svg/free.svg#cil-lock-locked') }}">
                                                </use>
                                            </svg></span>
                                        <input class="form-control" type="password" name="password" id="password"
                                            placeholder="Password" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-primary px-4" type="submit">Login</button>
                                        </div>
                                        {{-- <div class="col-6 text-end">
                                            <button class="btn btn-link px-0" type="button">Forgot password?</button>
                                        </div> --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card text-white bg-primary">
                            <div class="card-body text-center">

                                {{-- <img src="{{ asset('image/rumahsakit.jpg') }}" width="350px" alt=""> --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
