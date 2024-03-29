@extends('layouts.app')

@section('usermain')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Profile') }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="h5">
                                    Update {{ __('Profile Information') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <form id="profile" method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="mt-1 ">
                                        {{ __("Update your account's profile information and email address.") }}
                                    </p>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">

                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input id="name" name="name" type="text" class="mb-1 form-control"
                                        value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input id="email" name="email" type="email" class="mb-1 form-control"
                                        value="{{ old('email', $user->email) }}" required autocomplete="username">

                                </div>
                            </div>

                        </div>
                        <div class="card-footer rounded-bottom border-top bg-white">
                            <center>
                                <button class="btn btn-success mr-1"><i class="fa-solid fa-floppy-disk"></i>
                                    Save</button>
                                <a href="{{ route('dashboard') }}" class="btn btn-primary"><i class="fa-solid fa-xmark"></i>
                                    Cancel</a>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="h5">
                                    {{ __('Update Password') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <form id="pass" method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="mt-1 ">
                                        {{ __('Ensure your account is using a long, random password to stay secure.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="current_password">Current Password <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="current_password" name="current_password" type="password"
                                            class="form-control" autocomplete="current-password"
                                            placeholder="Enter Current Password" oncopy="return disableCopy();"
                                            onpaste="return disablePaste();" oncut="return disableCut();"
                                            oncontextmenu="return disableContextMenu();">
                                        <span class="input-group-append">
                                            <button tabindex="-1" type="button" id="Current_Password_Btn"
                                                class="btn btn-light border btn-flat"><i id="cur_btn"
                                                    class="fa-solid fa-lock"></i></button>
                                        </span>
                                        <div class="col-12"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="password">New Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="password" name="password" type="password" class="form-control"
                                            autocomplete="new-password" placeholder="Enter New Password"
                                            oncopy="return disableCopy();" onpaste="return disablePaste();"
                                            oncut="return disableCut();" oncontextmenu="return disableContextMenu();">
                                        <span class="input-group-append">
                                            <button tabindex="-1" type="button" id="password_btn"
                                                class="btn btn-light border btn-flat"><i id="pass_btn"
                                                    class="fa-solid fa-lock"></i></button>
                                        </span>
                                        <div class="col-12"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="password_confirmation">Confirm Password <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="password_confirmation" name="password_confirmation" type="password"
                                            class="form-control" autocomplete="new-password"
                                            placeholder="Enter Confirm Password" oncopy="return disableCopy();"
                                            onpaste="return disablePaste();" oncut="return disableCut();"
                                            oncontextmenu="return disableContextMenu();">
                                        <span class="input-group-append">
                                            <button tabindex="-1" type="button" id="password_confirmation_btn"
                                                class="btn btn-light border btn-flat"><i id="pass_con_btn"
                                                    class="fa-solid fa-lock"></i></button>
                                        </span>
                                        <div class="col-12"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer rounded-bottom border-top bg-white">
                            <center>
                                <button class="btn btn-success mr-2" type="submit"><i class="fa-solid fa-file-pen"></i>
                                    Update
                                </button>
                                <a href="{{ route('admin.dashboard') }}" class="btn text-white btn-primary"><i
                                        class="fa-solid fa-xmark"></i>
                                    Cancel</a>
                            </center>
                        </div>


                    </form>
                </div>
            </div>
        </section>

    </div>
@endsection
@section('script')
    <script>
        @if (session('success'))
            Swal.fire({
                title: "Success",
                text: "{{ Session::get('success') }}",
                icon: 'success',
                showCloseButton: true,
                confirmButtonText: '<i class="fa-regular fa-thumbs-up"></i> Great!',
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: "Ohoo",
                text: "{{ Session::get('error') }}",
                icon: 'error',
                showCloseButton: true,
                confirmButtonText: '<i class="fa-regular fa-thumbs-down"></i> Opps!',
            });
        @endif

        @if (session('status'))
            Swal.fire({
                title: "Success",
                text: "{{ Session::get('status') }}",
                icon: 'success',
                showCloseButton: true,
                confirmButtonText: '<i class="fa-regular fa-thumbs-up"></i> Great!',
            });
        @endif

        $('#profile').validate({
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                name: {
                    required: "Name is required.",
                },
                email: {
                    required: "Email address is required.",
                    email: "Please enter a valid email address."
                }
            },
            errorPlacement: function(error, element) {
                error.css('color', 'red').appendTo(element.parent("div"));
            },
            submitHandler: function(form) {
                $(':button[type="submit"]').prop('disabled', true);
                form.submit();
            }
        });

        $('#pass').validate({
            rules: {
                current_password: {
                    required: true,
                    minlength: 8,
                },
                password: {
                    required: true,
                    minlength: 8,
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password"
                }
            },
            messages: {
                current_password: {
                    required: "Current password is required.",
                    minlength: "Please enter at least 8 characters."
                },
                password: {
                    required: "New password is required.",
                    minlength: "Please enter at least 8 characters."
                },
                password_confirmation: {
                    required: "Confirm password is required.",
                    minlength: "Please enter at least 8 characters.",
                    equalTo: "Confirm password is not same as password."
                }
            },
            errorPlacement: function(error, element) {
                error.css('color', 'red').appendTo(element.parent("div"));
            },
            submitHandler: function(form) {
                $(':button[type="submit"]').prop('disabled', true);
                form.submit();
            }
        });

        $(document).ready(function() {

            //current_password_eye_btn for view enter password
            $("#Current_Password_Btn").click(function(e) {
                e.preventDefault();
                var input = $("#current_password");
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                    $('#cur_btn').removeClass('fa-solid fa-lock');
                    $('#cur_btn').addClass('fa-solid fa-unlock-keyhole');
                } else {
                    input.attr("type", "password");
                    $('#cur_btn').removeClass('fa-solid fa-unlock-keyhole');
                    $('#cur_btn').addClass('fa-solid fa-lock');
                }
            });

            //password_eye_btn for view enter password
            $("#password_btn").click(function(e) {
                e.preventDefault();
                var input = $("#password");
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                    $('#pass_btn').removeClass('fa-solid fa-lock');
                    $('#pass_btn').addClass('fa-solid fa-unlock-keyhole');
                } else {
                    input.attr("type", "password");
                    $('#pass_btn').removeClass('fa-solid fa-unlock-keyhole');
                    $('#pass_btn').addClass('fa-solid fa-lock');
                }
            });

            //password_confirmation_eye_btn for view enter password
            $("#password_confirmation_btn").click(function(e) {
                e.preventDefault();
                var input = $("#password_confirmation");
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                    $('#pass_con_btn').removeClass('fa-solid fa-lock');
                    $('#pass_con_btn').addClass('fa-solid fa-unlock-keyhole');
                } else {
                    input.attr("type", "password");
                    $('#pass_con_btn').removeClass('fa-solid fa-unlock-keyhole');
                    $('#pass_con_btn').addClass('fa-solid fa-lock');
                }
            });
        });

        function disableCopy() {
            Swal.fire({
                title: "Error",
                text: "You cannot perform Copy.",
                icon: 'error',
                showCloseButton: true,
                confirmButtonText: 'Ok !',
            });
            return false;
        }

        function disablePaste() {
            Swal.fire({
                title: "Error",
                text: "You cannot perform Paste.",
                icon: 'error',
                showCloseButton: true,
                confirmButtonText: 'Ok !',
            });
            return false;
        }

        function disableCut() {
            Swal.fire({
                title: "Error",
                text: "You cannot perform Cut.",
                icon: 'error',
                showCloseButton: true,
                confirmButtonText: 'Ok !',
            });
            return false;
        }

        function disableContextMenu() {
            Swal.fire({
                title: "Error",
                text: "You cannot perform right click via mouse as well as keyboard.",
                icon: 'error',
                showCloseButton: true,
                confirmButtonText: 'Ok !',
            });

            return false;
        }
    </script>
@endsection
