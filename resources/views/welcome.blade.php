@extends('layout.main')

@push('styles')
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0 !important;
            border-top-right-radius: 0 !important;
        }
    </style>
@endpush

@section('container')
    <div class="mt-5">

        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-5">

                <h1 class="MT-5 text-center">{{ $sesi }}</h1>
            </div>

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

        </div>

        <div class="mt-5 form-signin w-100 m-auto">
            <form action="/login" method="post">
                @csrf
                <div class="form-floating">
                    <input autofocus required type="text" class="form-control shadow-none" id="username" name="username"
                        placeholder="parmin" value="{{ old('username') }}">
                    <label for="username"><small>Nama Pengguna</small></label>
                </div>
                <div class="form-floating">
                    <input required type="password" class="form-control shadow-none" id="password" name="password"
                        placeholder="Password">
                    <label for="password"><small>Password</small></label>
                </div>
                <button class="w-100 btn btn-lg btn-success mt-3 shadow-sm" type="submit">Sign in</button>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
