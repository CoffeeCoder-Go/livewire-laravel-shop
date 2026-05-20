<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    </head>
    <body >
        <nav class="navbar navbar-expand-lg bg-primary">
            <div class="container-fluid">
                <a href="{{ route('home') }}" class="navbar-brand">Laravel Shop</a>

                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <a href="{{ route('products.products') }}" class="nav-link">Products</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('users.logout') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-light">Logout</button>
                            </form>

                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('users.login') }}" class="nav-link">Login</a>
                            
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.signup') }}" class="nav-link">Signup</a>
                        </li>
                    @endauth
                
                </ul>
            </div>

        </nav>

        <div class="d-flex justify-content-center">
            {{ $slot }}
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        @livewireScripts
    </body>
</html>
