<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.head')
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed layout-footer-fixed">
    <div class="wrapper">

        @include('layouts.partials.navbar')

        @include('layouts.partials.sidebar')

        @yield('usermain')

        @include('layouts.partials.footer')
    </div>


    @include('layouts.partials.script')
    @yield('script')
</body>

</html>
