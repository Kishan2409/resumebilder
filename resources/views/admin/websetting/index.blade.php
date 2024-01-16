@extends('admin.layouts.app')

@section('title', $moduleName)

@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $moduleName }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ $moduleName }}</li>
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
                                    Update {{ $moduleName }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <form id="add" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="title">Title<span class="text-danger">*</span></label>
                                    <input type="text" id="title" name="title" class="form-control"
                                        placeholder="Enter web title here" value="{{ $setting->title ?? '' }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label for="logo">logo<span class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" name="logo" class="custom-file-input" id="logo">
                                        <label class="custom-file-label" for="logo">Choose
                                            file</label>
                                    </div>
                                </div>
                                <div id="previewlogo" class="col-md-3 d-flex justify-content-center">
                                    @if (!empty($setting->logo))
                                        <img src="{{ asset('public/storage/logo/' . $setting->logo) }}"
                                            alt="Logo File Preview Fetch Database" width="150">
                                    @endif

                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="favicon">favicon<span class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" name="favicon" class="custom-file-input" id="favicon">
                                        <label class="custom-file-label" for="favicon">Choose
                                            file</label>
                                    </div>
                                </div>
                                <div id="previewfavicon" class="col-md-3 d-flex justify-content-center">
                                    @if (!empty($setting->favicon))
                                        <img src="{{ asset('public/storage/favicon/' . $setting->favicon) }}"
                                            alt="Favicon File Preview Fetch Database" width="150">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer rounded-bottom border-top bg-white">
                            <center>
                                <button class="btn btn-success mr-1"><i class="fa-solid fa-floppy-disk"></i>
                                    Save</button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary"><i
                                        class="fa-solid fa-xmark"></i>
                                    Cancel</a>
                            </center>
                        </div>
                    </form>
                </div>

                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
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

        $("#add").validate({
            rules: {
                title: {
                    required: true
                },
                logo: {
                    extension: "jpeg|jpg|png|gif|webp"
                },
                favicon: {
                    extension: "jpeg|jpg|png|gif|webp"
                }
            },
            messages: {
                title: {
                    required: "Title is required."
                },
                logo: {
                    extension: "Please enter a value with a valid extension for logo file."
                },
                favicon: {
                    extension: "Please enter a value with a valid extension for favicon file."
                }
            },
            errorPlacement: function(error, element) {
                error.css('color', 'red').appendTo(element.parent("div"));
            }
        });

        $(document).ready(function() {

            // Listen for changes in the file input
            $("#logo").change(function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("#previewlogo").html('<img src="' + e.target
                            .result +
                            '" alt="Logo File Preview" width="150">');
                    };
                    reader.readAsDataURL(file);
                } else {
                    $("#previewlogo").html("");
                }
            });

            $("#favicon").change(function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("#previewfavicon").html('<img src="' + e.target
                            .result +
                            '" alt="Favicon File Preview" width="150">');
                    };
                    reader.readAsDataURL(file);
                } else {
                    $("#previewfavicon").html("");
                }
            });
        });
    </script>
@endsection
