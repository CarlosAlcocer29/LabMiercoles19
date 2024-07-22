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

    <!-- Styles -->
    @vite(['resources/css/app.css']) <!-- Asegúrate de que tu archivo app.css esté correctamente configurado -->

    <!-- Additional CSS -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #F2F2F2; /* Color de fondo general */
        }

        .bg-green-500 {
            background-color: #03A6A6; /* Color verde específico */
        }

        .btn-primary {
            background-color: #03A6A6; /* Color del botón primario */
            border: none;
            color: white;
        }

        .btn-primary:hover {
            background-color: #028a8c; /* Color al pasar el mouse por encima */
        }

        .header {
            background-color: #ffffff; /* Color de fondo del encabezado */
            padding: 1rem;
            border-bottom: 1px solid #ddd; /* Línea debajo del encabezado */
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
        }

        /* Agrega aquí más estilos personalizados según sea necesario */
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="header shadow">
                <div class="container">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="container mt-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
