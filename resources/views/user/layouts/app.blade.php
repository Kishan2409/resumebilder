<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.layouts.partials.head')
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="51">
    <div class="wrapper">
        @include('user.layouts.partials.sidebar')
        @yield('main')
    </div>

    @include('user.layouts.partials.script')
    @yield('script')
</body>

</html>
