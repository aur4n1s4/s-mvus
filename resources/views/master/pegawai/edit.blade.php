@extends('layouts.app')

@section('title', $title)

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-fancybox.min.css') }}">

    <style>
        .float-right-top {
            height: 425px;
            top: 0px;
            right: 0;
        }
    </style>
@endsection

@section('content')
    <div class="page has-sidebar-left bg-light">
        <header class="blue accent-3 relative nav-sticky">
            <div class="container-fluid text-white">
                <div class="row">
                    <div class="col">
                        <h4>
                            <i class="icon icon-users"></i> Edit {{ $subTitle }}
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                        <li>
                            <a class="nav-link" href="javascript:history.back()">
                                <i class="icon icon-arrow_back"></i>Kembali</a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <div class="container-fluid my-3">
            <!-- Start Form -->
            <div class="col-md-12 p-2">
                <div id="alert"></div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <h6>
                                    <strong>
                                        <span id="formTitle">Edit - {{ $subTitle }}</span>
                                    </strong>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" id="form" method="POST"
                            data-url="{{ route($route . 'update', ':id') }}" novalidate>
                            @csrf
                            {{ method_field('PATCH') }}
                            <input type="hidden" name="id" id="id" value="{{ $employee->id }}">
                            <div class="form-row form-inline">
                                <div class="col-md-6 float-right-top">
                                    <!-- NIK -->
                                    <div class="form-group m-1">
                                        <label for="nik" class="col-form-label s-12 col-md-4">NIK</label>
                                        <input type="text" name="nik" id="nik" placeholder=""
                                            class="form-control r-0 light s-12 col-md-8" autocomplete="off" minlength="16"
                                            maxlength="16" value="{{ $employee->nik }}" required />
                                    </div>

                                    <!-- Nama Pegawai -->
                                    <div class="form-group m-1">
                                        <label for="" class="col-form-label s-12 col-md-4">
                                            Nama
                                        </label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="first_name" id="first_name"
                                                    class="form-control r-0 light s-12" autocomplete="off"
                                                    placeholder="First Name" value="{{ $employee->first_name }}" required />
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="last_name" id="last_name"
                                                    class="form-control r-0 light s-12" autocomplete="off"
                                                    placeholder="Last Name" value="{{ $employee->last_name }}" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Phone Number -->
                                    <div class="form-group m-1">
                                        <label for="phone_number" class="col-form-label s-12 col-md-4">
                                            Telp
                                        </label>
                                        <input type="text" name="phone_number" id="phone_number"
                                            class="form-control r-0 light s-12 col-md-8" autocomplete="off" minlength="10"
                                            maxlength="14" value="{{ $employee->phone_number }}" required />
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group m-1">
                                        <label for="email" class="col-form-label s-12 col-md-4">
                                            Email
                                        </label>
                                        <input type="email" name="email" id="email"
                                            class="form-control r-0 light s-12 col-md-8" autocomplete="off"
                                            value="{{ $employee->email }}" required />
                                    </div>

                                    <!-- Jenis Kelamin -->
                                    <div class="form-group m-1">
                                        <label for="gender" class="col-form-label s-12 col-md-4">
                                            Jenis Kelamin
                                        </label>
                                        <select name="gender" id="gender" class="form-control r-0 light s-12 col-md-8"
                                            required>
                                            <option value="">Pilih</option>
                                            <option value="L" @if ($employee->gender == 'L') selected @endif>
                                                Laki-Laki</option>
                                            <option value="P" @if ($employee->gender == 'P') selected @endif>
                                                Perempuan</option>
                                        </select>
                                    </div>

                                    <!-- Tempat Lahir -->
                                    <div class="form-group m-1">
                                        <label for="t_lahir" class="col-form-label s-12 col-md-4">
                                            Tempat Lahir
                                        </label>
                                        <input type="text" name="t_lahir" id="t_lahir"
                                            class="form-control r-0 light s-12 col-md-8" autocomplete="off"
                                            value="{{ $employee->t_lahir }}" required />
                                    </div>

                                    <!-- Hari lahir -->
                                    <div class="form-group m-1">
                                        <label for="d_lahir" class="col-form-label s-12 col-md-4">
                                            Tanggal Lahir
                                        </label>
                                        <input type="date" name="d_lahir" id="d_lahir"
                                            class="form-control r-0 light s-12 col-md-8" autocomplete="off"
                                            value="{{ $employee->d_lahir }}" required />
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12 my-2">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary btn-sm" id="action">
                                        <i class="icon-save mr-2"></i>
                                        Simpan
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- End Form -->
        </div>
    </div>
    </div>
@endsection

@section('script')
    <!-- LIBRARY -->
    <script src="{{ asset('backend/js/jquery-fancybox.min.js') }}"></script>
    <script src="{{ asset('backend/js/jquery-confirm.min.js') }}"></script>

    <!-- UPDATE -->
    <script type="text/javascript">
        $('#form').on('submit', function(e) {
            if ($(this)[0].checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                $('#alert').html('');
                $('#action').attr('disabled', true);
                $.ajax({
                    url: $(this).data('url').replace(':id', $('#id').val()),
                    type: 'POST',
                    data: new FormData($(this)[0]),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#action').removeAttr('disabled');
                        $('#alert').html(
                            "<div role='alert' class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Success!</strong> " +
                            data + "</div>");

                        //-- Reset Form
                        // resetForm();

                        //-- Location Reload
                        window.location.reload();

                    },
                    error: function(data, textStatus, errorMessage) {
                        $('#action').removeAttr('disabled');
                        err = '';
                        if (data.status == 422) {
                            respon = data.responseJSON;
                            $.each(respon.errors, function(index, value) {
                                err = err + "<li>" + value + "</li>";
                            });
                        } else {
                            err = "<li>" + data.responseText + "</li>";
                        }

                        $('#alert').html(
                            "<div role='alert' class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>" +
                            textStatus.toUpperCase() + " : </strong> " + errorMessage +
                            "<ol class='pl-3 m-0'>" + err + "</ol></div>");
                    }
                });
                return false;
            }
            $(this).addClass('was-validated');
        });
    </script>

    <!-- UTILS -->
    <script type="text/javascript">
        $('.date-time-picker').datetimepicker({
            format: 'Y-m-d',
            timepicker: false,
        });

        function resetForm() {
            $('#form').trigger('reset');
        }
    </script>
@endsection
