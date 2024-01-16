<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ Helper::Settings() == null ? 'TEST' : Helper::Settings()->title }} | @yield('title')</title>

<link rel="icon"
    href="{{ asset(!empty(Helper::Settings()->favicon) ? 'public/storage/favicon/' . Helper::Settings()->favicon : '') }}"
    type="image/png">

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('public/admin/plugins/fontawesome-free/css/all.min.css') }}">

<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<!-- iCheck -->
<link rel="stylesheet" href="{{ asset('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('public/admin/dist/css/adminlte.min.css') }}">

<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

<!-- summernote -->
<link rel="stylesheet" href="{{ asset('public/admin/plugins/summernote/summernote-bs4.min.css') }}">

<!-- sweetalert2 -->
<link rel="stylesheet" href="{{ asset('public/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
