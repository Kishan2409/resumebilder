@extends('layouts.app')

@section('usermain')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="h5">
                                    Add Experience Section
                                </h5>
                            </div>

                        </div>
                    </div>
                    <form id="experience" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="joining_date">Joining Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="joining_date" name="joining_date">
                                </div>
                                <div class="col-md-6">
                                    <label for="leaving_date">Leaving Date </label>
                                    <input type="date" class="form-control" id="leaving_date" name="leaving_date">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="company_name">Company Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter company name"
                                        id="company_name" name="company_name">
                                </div>
                                <div class="col-md-6">
                                    <label for="role">Role <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter your role" id="role"
                                        name="role">
                                </div>

                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="company_address">Company Address <span class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" placeholder="Enter company address" id="company_address"
                                        name="company_address"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="company_description">Company Description </label>
                                    <textarea type="text" class="form-control" placeholder="Enter description about company" id="company_description"
                                        name="company_description"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Status <span class="text-danger">*</span></label>
                                    <div class="mt-2 form-group clearfix">
                                        <div class="icheck-success d-inline ml-5">
                                            <input type="radio" id="active" name="status" value="1" checked>
                                            <label for="active">Active
                                            </label>
                                        </div>
                                        <div class="icheck-danger d-inline ml-5">
                                            <input type="radio" name="status" id="inactive" value="0">
                                            <label for="inactive">Inactive
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer rounded-bottom border-top bg-white">
                            <center>
                                <button class="btn btn-success mr-1 save"><i class="fa-solid fa-floppy-disk"></i>
                                    Save</button>
                                <a href="{{ route('user.experience.index') }}" class="btn btn-primary"><i
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
        $(document).ready(function() {
            $('#experience').validate({
                rules: {
                    joining_date: {
                        required: true,
                    },
                    company_name: {
                        required: true,
                    },
                    company_address: {
                        required: true,
                    },
                    role: {
                        required: true,
                    }
                },
                messages: {
                    joining_date: {
                        required: "Joining date is required.",
                    },
                    company_name: {
                        required: "Company name is required.",
                    },
                    company_address: {
                        required: "Company address is required.",
                    },
                    role: {
                        required: "Role name is required.",
                    }
                },
                errorPlacement: function(error, element) {
                    error.appendTo(element.parent("div")).css('color', 'red');
                },
                submitHandler: function(form) {
                    $(':button[type="submit"]').prop('disabled', true);
                    form.submit();
                }
            });

        });
    </script>
@endsection
