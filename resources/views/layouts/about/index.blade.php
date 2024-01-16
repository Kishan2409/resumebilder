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
                                    About Section
                                </h5>
                            </div>
                        </div>
                    </div>

                    <form id="about" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Enter description">
@if (!empty($data))
{{ $data->description }}
@endif
</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="image">Image (.jpeg | .jpg | .png | .webp) <span
                                            class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="image">Choose
                                            file</label>
                                    </div>

                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-12">
                                    <div id="imageview">

                                        @if (!empty($data))
                                            <img src="{{ asset('public/storage/about/' . $data->image) }}"
                                                alt="Poster File Preview" width="150">
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer rounded-bottom border-top bg-white">
                            <center>
                                <button class="btn btn-success mr-1 save"><i class="fa-solid fa-floppy-disk"></i>
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="h5">
                                            Skills Section
                                        </h5>

                                    </div>
                                    <div class="col-md-6 ">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                            data-target="#staticBackdrop">
                                            Add Skills
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Skill Name</th>
                                            <th>Percentage</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="h5">
                                            Education Section
                                        </h5>
                                    </div>
                                    <div class="col-md-6 ">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                            data-target="#staticBackdrop_addEducation">
                                            Add Education Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="education_example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Degree Name</th>
                                            <th>Pass Out Year</th>
                                            <th>File</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>




        <!-- addModal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Skills</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="skills" method="post" action="{{ route('user.skill.store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="skills_name">Skill Name <span class="text-danger">*</span></label>
                                    <input type="text" name="skills_name" id="skills_name" class="form-control"
                                        placeholder="Enter skill name">
                                </div>
                                <div class="col-md-6">
                                    <label for="skills_percentage">Skill Percentage <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="skills_percentage" id="skills_percentage"
                                        class="form-control" placeholder="Enter skill lavel in number">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->

        <!-- editModal -->
        <div class="modal fade" id="staticBackdropedit" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Skills</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="edit_skills" method="post" action="{{ route('user.skill.update') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="edit_skills_id" hidden>Skill id <span class="text-danger">*</span></label>
                                    <input type="text" name="edit_skills_id" id="edit_skills_id" class="form-control"
                                        readonly hidden>
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_skills_name">Skill Name <span class="text-danger">*</span></label>
                                    <input type="text" name="edit_skills_name" id="edit_skills_name"
                                        class="form-control" placeholder="Enter skill name">
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_skills_percentage">Skill Percentage <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="edit_skills_percentage" id="edit_skills_percentage"
                                        class="form-control" placeholder="Enter skill lavel in number">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->

        <!-- addEducationModal -->
        <div class="modal fade" id="staticBackdrop_addEducation" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Education Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="education" method="post" enctype="multipart/form-data"
                        action="{{ route('user.education.store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="degree_name">Degree Name <span class="text-danger">*</span></label>
                                    <input type="text" name="degree_name" id="degree_name" class="form-control"
                                        placeholder="Enter degree name">
                                </div>
                                <div class="col-md-6">
                                    <label for="pass_out_year">Pass Out Year <span class="text-danger">*</span></label>
                                    <input type="text" name="pass_out_year" maxlength="4" id="pass_out_year"
                                        class="form-control" placeholder="Enter Passing Year">
                                </div>
                                <div class="col-md-12">
                                    <label for="result_image">Result Image (.jpeg | .jpg | .png | .webp) <span
                                            class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" name="result_image" class="custom-file-input"
                                            id="result_image">
                                        <label class="custom-file-label" for="result_image">Choose
                                            file</label>
                                    </div>
                                    <div id="result_imageview" class="mt-2 d-flex justify-content-center">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->

        <!-- editEducationModal -->
        <div class="modal fade" id="staticBackdrop_editEducation" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Education Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="educationupdate" method="post" enctype="multipart/form-data"
                        action="{{ route('user.education.update') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="edit_education_id" hidden>Education id <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="edit_education_id" id="edit_education_id"
                                        class="form-control" readonly hidden>
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_degree_name">Degree Name <span class="text-danger">*</span></label>
                                    <input type="text" name="edit_degree_name" id="edit_degree_name"
                                        class="form-control" placeholder="Enter degree name">
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_pass_out_year">Pass Out Year <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="edit_pass_out_year" maxlength="4"
                                        id="edit_pass_out_year" class="form-control" placeholder="Enter Passing Year">
                                </div>
                                <div class="col-md-12">
                                    <label for="edit_result_image">Result Image (.jpeg | .jpg | .png | .webp) <span
                                            class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" name="edit_result_image" class="custom-file-input"
                                            id="edit_result_image">
                                        <label class="custom-file-label" for="edit_result_image">Choose
                                            file</label>
                                    </div>
                                    <div id="edit_result_imageview" class="mt-2 d-flex justify-content-center">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->
    @endsection
    @section('script')
        <script>
            // Update validation rules for all 'skills[]' inputs
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
                    title: "Error",
                    text: "{{ Session::get('error') }}",
                    icon: 'error',
                    showCloseButton: true,
                });
            @endif

            $(document).ready(function() {

                //about validation
                var validator = $('#about').validate({
                    rules: {
                        description: {
                            required: true,
                        },
                        image: {
                            required: true,
                            extension: "jpeg|jpg|png|gif|webp",
                        }
                    },
                    messages: {
                        description: {
                            required: "Description is required.",
                        },
                        image: {
                            required: "Image is required.",
                            extension: "Please enter a value with a valid extension for Image.",
                        }
                    },
                    errorPlacement: function(error, element) {
                        error.css('color', 'red');
                        if (element.hasClass('skills')) {
                            error.appendTo(element.closest("td"));
                        } else {
                            error.appendTo(element.parent("div"));
                        }
                    },
                    submitHandler: function(form) {
                        $(':button[type="submit"]').prop('disabled', true);
                        form.submit();
                    }
                });

                //about image view
                $("#image").change(function() {
                    var file = this.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $("#imageview").html('<img src="' + e.target
                                .result +
                                '" alt="Iamage File Preview" width="150">');
                        };
                        reader.readAsDataURL(file);
                    } else {
                        $("#imageview").html("");
                    }
                });

                //skills validation
                $('#skills').validate({
                    rules: {
                        skills_name: {
                            required: true,
                        },
                        skills_percentage: {
                            required: true,
                            max: 100
                        }
                    },
                    messages: {
                        skills_name: {
                            required: "Skills name is required.",
                        },
                        skills_percentage: {
                            required: "Skills percentage is required.",
                            max: "Please enter a value less than or equal to 100%."
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

                //datatable Skills
                var table = $('#example').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('get.skill.data') }}",
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'skills_name',
                            searchable: true,
                        },
                        {
                            data: 'skills_percentage',
                            searchable: true,
                        },
                        {
                            data: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                });

                //skill delete btn
                $("#example").on('click', '.delete', function(e) {
                    e.preventDefault();
                    var input = $(this);
                    var Id = input.data("id")

                    Swal.fire({
                        title: "Are you sure ?",
                        text: "Are you sure you want to delete this skills.",
                        icon: "warning",
                        showCancelButton: true,
                        cancelButtonColor: '#d33',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "get",
                                url: "{{ route('user.skill.destroy') }}",
                                data: {
                                    'id': Id,
                                },
                                success: function(Id) {
                                    table.ajax.reload();
                                    Swal.fire(
                                        'Deleted!',
                                        'Your skill has been deleted.',
                                        'success'
                                    )
                                }
                            });
                        }
                    })
                });

                //edit skills validation
                $('#edit_skills').validate({
                    rules: {
                        edit_skills_name: {
                            required: true,
                        },
                        edit_skills_percentage: {
                            required: true,
                            max: 100
                        }
                    },
                    messages: {
                        edit_skills_name: {
                            required: "Skills name is required.",
                        },
                        edit_skills_percentage: {
                            required: "Skills percentage is required.",
                            max: "Please enter a value less than or equal to 100%."
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

                //edit-skills modal view
                $("#example").on('click', '.edit-btn', function() {
                    var rowId = $(this).data('id');

                    // Use AJAX to fetch data for the selected row from the server
                    $.ajax({
                        url: "{{ route('user.skill.edit') }}",
                        type: 'GET',
                        data: {
                            id: rowId
                        },
                        success: function(data) {
                            // Fill the modal with data
                            $('#edit_skills_id').val(data.data.id);
                            $('#edit_skills_name').val(data.data.skills_name);
                            $('#edit_skills_percentage').val(data.data.skills_percentage);
                        }
                    });
                });

                //datatable education
                var table = $('#education_example').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('get.education.data') }}",
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'education_degree_name',
                            searchable: true,
                        },
                        {
                            data: 'education_pass_out_year',
                            searchable: true,
                        },
                        {
                            data: 'education_result_image',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                });

                //education validation
                $('#education').validate({
                    rules: {
                        degree_name: {
                            required: true,
                        },
                        pass_out_year: {
                            required: true,
                            max: 2024,
                            min: 1900
                        },
                        result_image: {
                            extension: "jpeg|jpg|png|webp",
                        }
                    },
                    messages: {
                        degree_name: {
                            required: "Degree name is required.",
                        },
                        pass_out_year: {
                            required: "Pass out year is required.",
                            max: "Please enter a value less than or equal to 2024.",
                            min: "Please enter a value greater than or equal to 1900."
                        },
                        result_image: {
                            extension: "Please enter a value with a valid extension for Result image.",
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

                //education image view
                $("#result_image").change(function() {
                    var file = this.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $("#result_imageview").html('<img src="' + e.target
                                .result +
                                '" alt="Iamage File Preview" width="200">');
                        };
                        reader.readAsDataURL(file);
                    } else {
                        $("#result_imageview").html("");
                    }
                });

                //edit-education modal view
                $("#education_example").on('click', '.edit-btn', function() {
                    var rowId = $(this).data('id');

                    // Use AJAX to fetch data for the selected row from the server
                    $.ajax({
                        url: "{{ route('user.education.edit') }}",
                        type: 'GET',
                        data: {
                            id: rowId
                        },
                        success: function(data) {
                            // Fill the modal with data
                            var name = data.data.education_result_image;
                            var path = "{{ asset('public/storage/education/') }}" + "/" + name;
                            $('#edit_education_id').val(data.data.id);
                            $('#edit_degree_name').val(data.data.education_degree_name);
                            $('#edit_pass_out_year').val(data.data.education_pass_out_year);
                            $("#edit_result_imageview").html('<img src="' + path +
                                '" alt="Iamage File Preview" width="200">');
                        }
                    });
                });

                //education update validation
                $('#educationupdate').validate({
                    rules: {
                        edit_degree_name: {
                            required: true,
                        },
                        edit_pass_out_year: {
                            required: true,
                            max: 2024,
                            min: 1900
                        },
                        edit_result_image: {
                            extension: "jpeg|jpg|png|webp",
                        }
                    },
                    messages: {
                        edit_degree_name: {
                            required: "Degree name is required.",
                        },
                        edit_pass_out_year: {
                            required: "Pass out year is required.",
                            max: "Please enter a value less than or equal to 2024.",
                            min: "Please enter a value greater than or equal to 1900."
                        },
                        edit_result_image: {
                            extension: "Please enter a value with a valid extension for Result image.",
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

                //edit education image view
                $("#edit_result_image").change(function() {
                    var file = this.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $("#edit_result_imageview").html('<img src="' + e.target
                                .result +
                                '" alt="Iamage File Preview" width="200">');
                        };
                        reader.readAsDataURL(file);
                    } else {
                        $("#edit_result_imageview").html("");
                    }
                });


                //education delete btn
                $("#education_example").on('click', '.delete', function(e) {
                    e.preventDefault();
                    var input = $(this);
                    var Id = input.data("id")

                    Swal.fire({
                        title: "Are you sure ?",
                        text: "Are you sure you want to delete this education.",
                        icon: "warning",
                        showCancelButton: true,
                        cancelButtonColor: '#d33',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "get",
                                url: "{{ route('user.education.destroy') }}",
                                data: {
                                    'id': Id,
                                },
                                success: function(Id) {
                                    table.ajax.reload();
                                    Swal.fire(
                                        'Deleted!',
                                        'Your education has been deleted.',
                                        'success'
                                    )
                                }
                            });
                        }
                    })
                });

            });
        </script>
    @endsection
