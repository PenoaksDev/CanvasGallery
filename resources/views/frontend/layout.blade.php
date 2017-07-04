<!DOCTYPE html>
<html lang="en">
    <head>
        @include('frontend.shared.partials.meta')
        @include('frontend.shared.partials.css')
    </head>
    <body>
        @include('frontend.shared.partials.header')
        @yield('content')
        @yield('unique-js')
        @include('frontend.shared.partials.footer')
    </body>
</html>
