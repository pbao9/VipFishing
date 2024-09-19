<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
<meta http-equiv="X-UA-Compatible" content="ie=edge"/>
<meta name="X-TOKEN" content="{{ csrf_token() }}">
<title>@yield('title', 'Admin')</title>
<link rel="shortcut icon" type="image/x-icon" href="{{ asset(config('custom.images.favicon')) }}" />
<!-- CSS files -->
<link href="{{ asset('/public/libs/tabler/dist/css/tabler.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('public/libs/jquery-toast-plugin/jquery.toast.min.css') }}" rel="stylesheet"
    type="text/css">
<link href="{{ asset('public/libs/Parsley.js-2.9.2/style.css') }}" rel="stylesheet">
<style>
    @import url('https://rsms.me/inter/inter.css');
    :root {
    --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }
    body {
    font-feature-settings: "cv03", "cv04", "cv11";
    }
</style>
@stack('libs-css')
@stack('custom-css')
    