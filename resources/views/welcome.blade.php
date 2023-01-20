<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bienes Inmuebles</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400&display=swap" rel="stylesheet">
    {{-- Bootstrap v5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<style>
    .titulo {
        font-family: 'Raleway', sans-serif;
        color: white
    }

    .nav-azul {
        background-color: #2a3964;
    }

    .nav-rojo {
        /* background-color: #EA1F26; */
        background-color: #9a0000;
        width: 100%;
        height: 90px;
    }

    /* Fondo */
    .fondo {
        background-image: url({{ asset('img/activoFijo.jpg') }});
        background-repeat: no-repeat;
        background-size: cover;
        height: 700px;
        position: relative;
    }
    /*  */
</style>

<body class="antialiased">
    <nav class="navbar navbar-expand-lg nav nav-azul navbar-dark a;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}" class="nav-link active titulo">Home</a>
                        @else
                            <li class="nav-item">
                                <a class="nav-link active titulo" aria-current="page" href="{{ route('login') }}">Iniciar
                                    Sesion</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link active titulo" href="{{ route('register') }}">Registrarse</a>
                                @endif
                            </li>
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="fondo">
        <div class="nav-rojo text-center">
            <h2 class="titulo pt-2">UNIDAD DE BIENES INMUEBLES</h2>
            <h5 class="titulo">DEPARTAMENTO DE ACTIVO FIJO</h5>
        </div>
    </div>
    {{-- js bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>
{{-- <footer class="pt-3 mt-4 text-muted border-top">
    &copy; 2022
</footer> --}}
</html>
