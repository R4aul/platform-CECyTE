<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: linear-gradient(to right, #5B1226, #9A3B17);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Figtree', sans-serif;
        }

        .container {
            max-width: 800px;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .logo {
            width: 150px;
            margin-bottom: 15px;
        }

        h1 {
            color: #9A3B17;
            font-size: 2rem;
            font-weight: bold;
        }

        p {
            color: #5B1226;
            font-size: 1.2rem;
            margin-top: 10px;
        }

        .btn {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #9A3B17;
            color: white;
        }

        .btn-primary:hover {
            background-color: #5B1226;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="{{asset('images/image_cecyte.jpg')}}" alt="Logo de la institución" class="logo">
        <h1>Bienvenidos al Plantel CECyTEH Mirador Capula No. 37</h1>
        <p>Plataforma de gestión de actividades para alumnos y docentes.</p>
        <p>Aquí podrás acceder y gestionar tus actividades de manera sencilla y eficiente.</p>

        <div class="buttons">
            <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
        </div>
    </div>
</body>

</html>
