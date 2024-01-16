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
                                    Hero Section
                                </h5>
                            </div>
                        </div>
                    </div>

                    <form id="hero" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input id="name" name="name" type="text" class="mb-1 form-control"
                                        value="{{ old('name', auth()->user()->name) }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input id="email" name="email" type="email" class="mb-1 form-control"
                                        value="{{ old('email', auth()->user()->email) }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <table class="table mt-5" id="skillsTable">
                                        <thead>
                                            <tr>
                                                <th>Skills <span class="text-danger">*</span></th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($data))
                                                @php
                                                    $skills = explode(',', $data->skills);
                                                    $length_arr_skills = count($skills);
                                                @endphp
                                                <p id="skillscount" hidden>{{ $length_arr_skills }}</p>
                                                @for ($i = 0; $i < $length_arr_skills; $i++)
                                                    <tr id="row0">
                                                        <td>
                                                            <div class="skillsdiv">
                                                                <input type="text" name="skills[]"
                                                                    class="form-control skills" placeholder="Enter skills"
                                                                    value="{{ $skills[$i] }}">
                                                                <p id="error{{ $i }}"
                                                                    class="error msg font-weight-bold " hidden>
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-success add-row mr-1">Add</button>
                                                            <button type="button"
                                                                class="btn btn-danger remove-row">Remove</button>
                                                        </td>
                                                    </tr>
                                                @endfor
                                            @else
                                                <p id="skillscount" hidden>1</p>

                                                <tr id="row0">
                                                    <td>
                                                        <div class="skillsdiv">
                                                            <input type="text" name="skills[]"
                                                                class="form-control skills" placeholder="Enter skills">
                                                            <p id="error0" class="error msg font-weight-bold " hidden>
                                                            </p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-success add-row mr-1">Add</button>
                                                        <button type="button"
                                                            class="btn btn-danger remove-row">Remove</button>
                                                    </td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="pimage">Poster Image (.jpeg | .jpg | .png | .webp) <span
                                            class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" name="pimage" class="custom-file-input" id="pimage">
                                        <label class="custom-file-label" for="pimage">Choose
                                            file</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="resume">Resume File (.pdf | .docx)<span
                                            class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" name="resume" class="custom-file-input" id="resume">
                                        <label class="custom-file-label" for="resume">Choose
                                            file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6 d-flex justify-content-center">
                                    <div id="preview">
                                        @if (!empty($data))
                                            <img src="{{ asset('public/storage/hero_poster/' . $data->image) }}"
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
                                <a href="{{ route('dashboard') }}" class="btn btn-primary"><i
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

        $(document).ready(function() {
            var validator = $('#hero').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    resume: {
                        required: true,
                        extension: "pdf|docx",
                    },
                    pimage: {
                        required: true,
                        extension: "jpeg|jpg|png|gif|webp",
                    }
                },
                messages: {
                    name: {
                        required: "Name is required.",
                    },
                    email: {
                        required: "Email is required.",
                        email: "Please enter a valid email address.",
                    },
                    resume: {
                        required: "Resume is required.",
                        extension: "Please enter a value with a valid extension for Resume file.",
                    },
                    pimage: {
                        required: "Poster image is required.",
                        extension: "Please enter a value with a valid extension for Poster image.",
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

            var rowCount = $("#skillscount").text(); // Initialize a counter for unique IDs
            // Add row
            $('body').on('click', '.add-row', function() {

                $('.skillsdiv input[type=text]').each(function(i, obj) {
                    var error = $(this).val();

                    if (error[i] == null) {
                        $("#error" + `${i}`).removeAttr('hidden');
                        $(this).after(
                            $("#error" + `${i}`).text("Skills is required.").css('color', 'red')
                        );
                        e.preventDefault();
                    } else {
                        $("#error" + `${i}`).attr("hidden", true);
                        $(this).after(
                            $("#error" + `${i}`).text(""));
                    }
                });

                var newRow = '<tr id="row' + rowCount + '">' +
                    '<td>' +
                    '<div class="skillsdiv">' +
                    '<input type="text" name="skills[]" class="form-control skills">' +
                    '<p id="error' + rowCount + '" class="error msg font-weight-bold " hidden></p>' +
                    '<div class="skillsdiv">' +
                    '</td > ' +
                    '<td>' +
                    '<button type="button" class="btn btn-success add-row mr-2">Add</button>' +
                    '<button type="button" class="btn btn-danger remove-row">Remove</button>' +
                    '</td>' +
                    '</tr>';
                $('#skillsTable tbody').append(newRow);

                rowCount++;
            });

            // Remove row
            $('body').on('click', '.remove-row', function() {
                // Ensure there is at least one row in the table
                if (rowCount != 1) {
                    $(this).parent().parent().remove();
                    rowCount--

                }
            });

            $('body').on('click', '.save', function(e) {
                $('.skillsdiv input[type=text]').each(function(i, obj) {
                    var error = $(this).val();

                    if (error[i] == null) {
                        $("#error" + `${i}`).removeAttr('hidden');
                        $(this).after(
                            $("#error" + `${i}`).text("Skills is required.").css('color', 'red')
                        );
                        e.preventDefault();
                    } else {
                        $("#error" + `${i}`).attr("hidden", true);
                        $(this).after(
                            $("#error" + `${i}`).text(""));
                    }
                });
            });


            $("#pimage").change(function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("#preview").html('<img src="' + e.target
                            .result +
                            '" alt="Poster File Preview" width="150">');
                    };
                    reader.readAsDataURL(file);
                } else {
                    $("#preview").html("");
                }
            });


        });
    </script>
@endsection
