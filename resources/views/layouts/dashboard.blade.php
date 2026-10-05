<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
</head>
<body>

@include('partials.dashboard.sidebar')
@include('partials.dashboard.topbar')

<main>
    @yield('content')
</main>

</body>
</html>
