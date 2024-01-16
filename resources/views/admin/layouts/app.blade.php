<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.partials.head')
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed layout-footer-fixed">
    <div class="wrapper">

        @include('admin.layouts.partials.navbar')

        @include('admin.layouts.partials.sidebar')

        @yield('main')

        @include('admin.layouts.partials.footer')
    </div>

    @include('admin.layouts.partials.script')
    @yield('script')
</body>

</html>
