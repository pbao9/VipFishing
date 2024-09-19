<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('admin.layouts.guest.head')
</head>
<body class="border-top-wide d-flex flex-column">

    @yield('content')
    
    @include('admin.layouts.guest.footer')
    @include('admin.layouts.guest.scripts')
    <x-alert />

</body>
</html>