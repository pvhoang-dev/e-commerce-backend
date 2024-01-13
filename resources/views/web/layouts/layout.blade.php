<!DOCTYPE html>
<html lang="en">
<head>
    @include('web.layouts.head')
    @stack('css')
</head>
<body>

@include('web.layouts.header')

{{--<main>--}}
@yield('content')
{{--</main>--}}

@include('web.layouts.footer')

@stack('scripts')
</body>
</html>
