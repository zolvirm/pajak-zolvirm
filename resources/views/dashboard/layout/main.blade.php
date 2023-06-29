<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zolvirm | DASHBOARD</title>
    @stack('styles')
    {{-- <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap5.2.3.min.css') }}"> --}}

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

</head>

<body>

    @include('dashboard.layout.header')

    <div class="container-fluid">
        <div class="row">
            @include('dashboard.layout.sidebar')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('container')
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('js/jquery-3.6.3.js') }}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"> </script>
    {{-- <script src="{{ asset('js/bootstrap@5.0.2.bundle.min.js') }}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('js/feather-icon@4.28.0.min.js') }}"></script> --}}

    <script src="{{ asset('js/dashboard.js') }}"></script>

    @stack('scripts')

</body>

</html>
