<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


    <title>Unstop's Full Stack Developer Challenge</title>
</head>

<body>

    {{-- Top Bar --}}
    <nav class="navbar navbar-dark color-theme">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                Unstop's Full Stack Developer Challenge
            </a>
        </div>
    </nav>

    @if ($errors->any())
        <div class="alert alert-danger">
            <h4 class="alert-heading">Attention !</h4>
            <ul class="mb-0">
                <li>One person can reserve up to 7 seats at a time.</li>
            </ul>
        </div>
    @endif

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
        </div>
    @elseif ($message = Session::get('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ $message }}
        </div>
    @endif


    @yield('content')



</body>

</html>
