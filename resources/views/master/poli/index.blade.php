@extends('layouts.app')

@section('title', $title)

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-fancybox.min.css') }}">
@endsection

@section('content')
    <div class="page has-sidebar-left bg-light">
        <header class="blue accent-3 relative nav-sticky">
            <div class="container-fluid text-white">
                <div class="row">
                    <div class="col">
                        <h3 class="my-2">
                            <i class="icon icon-document2"></i> {{ $subTitle }}
                        </h3>
                    </div>
                </div>
            </div>
        </header>
        <div class="container-fluid my-1">
            <div class="row">
                <div class="col-md-8 p-2">
                    <div class="card ">
                        <div class="card-header">
                            <h6>
                                <strong>
                                    Tabel - {{ $subTitle }}
                                </strong>
                            </h6>
                        </div>
                        <div class="card-body no-b">
                            <div class="table-responsive">
                                <table id="table" class="table table-striped" style="width:100%"
                                    data-url="{{ route($route . 'api') }}">
                                    <thead>
                                        <th width="30">No</th>
                                        <th>Nama</th>
                                        <th>Keterangan</th>
                                        <th width="60"></th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 p-2">
                    <div id="alert"></div>
                    <div class="card ">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-10">
                                    <h6>
                                        <strong>
                                            <span id="formTitle">
                                                Tambah
                                            </span>
                                            - {{ $subTitle }}
                                        </strong>
                                    </h6>
                                </div>
                                <div class="col-md-2" style="display: none; " id="btnReset">
                                    <a href='#' onclick='resetForm()' class='btn btn-outline-primary btn-xs'>Batal</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form class="needs-validation" id="form" method="POST" novalidate
                                data-store-url="{{ route($route . 'store') }}"
                                data-update-url="{{ route($route . 'update', ':id') }}">
                                @csrf
                                @method('POST')
                                <input type="hidden" id="id" name="id" />
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nama" class="col-form-label s-12">
                                                Nama <small class="text-danger">*</small>
                                            </label>
                                            <input type="text" name="nama" id="nama"
                                                class="form-control r-0 s-12" autocomplete="off" required />
                                        </div>

                                        <div class="form-group">
                                            <label for="keterangan" class="col-form-label s-12">
                                                Keterangan <small class="text-danger">*</small>
                                            </label>
                                            <textarea class="form-control r-0 s-12" name="keterangan" id="keterangan" rows="4" required></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="float-right">
                                            <button type="submit" class="btn btn-primary btn-sm" id="action">
                                                <i class="icon-save mr-2"></i>
                                                Simpan
                                                <span id="txtAction"></span></button>
                                            <a class="btn btn-sm" onclick="resetForm()" id="reset">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend/js/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('backend/js/jquery-fancybox.min.js') }}"></script>

    <script type="text/javascript">
        var table = $('#table').dataTable({
            processing: true,
            serverSide: true,
            ajax: $('#table').data('url'),
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    align: 'center',
                    className: 'text-center'
                },
                {
                    data: 'nama',
                    nama: 'nama'
                },
                {
                    data: 'keterangan',
                    nama: 'keterangan'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                }
            ]
        });

        $('#form').on('submit', function(e) {
            if ($(this)[0].checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                $('#alert').html('');
                $('#action').attr('disabled', true);

                var method = $('input[name=_method]').val();
                var url = $(this).data('store-url');

                // Jika method nya [PATCH]
                if (method === 'PATCH') {
                    url = $(this).data('update-url').replace(':id', $('#id').val());
                }

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: new FormData($(this)[0]),
                    contentType: false,
                    processData: false,
                    success: function(message) {
                        $('#action').removeAttr('disabled');
                        $('#alert').html(
                            "<div role='alert' class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Success!</strong> " +
                            message + "</div>");

                        //-- Reload Tabel
                        table.api().ajax.reload()

                        //-- Reset Form
                        resetForm();

                    },
                    error: function(data, textStatus, errorMessage) {
                        $('#action').removeAttr('disabled');
                        err = '';
                        if (data.status == 422) {
                            respon = data.responseJSON;
                            $.each(respon.errors, function(index, value) {
                                err = err + "<li>" + value + "</li>";
                            });
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

        function edit(e) {
            $('#alert').html('');
            $('#form').trigger('reset');
            $('#formTitle').html("Mohon tunggu beberapa saat...");
            $('#txtAction').html(" Perubahan");
            $('#reset').hide();
            $('input[name=_method]').val('PATCH');
            $('#btnReset').show();
            $.ajax({
                url: $(e).data('url'),
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#formTitle').html("Edit");
                    $('#id').val(data.id);
                    $('#nama').val(data.nama).focus();
                    $('#keterangan').val(data.keterangan);
                },
                error: function() {
                    reload();
                }
            });
        }

        function remove(e) {
            $.confirm({
                title: '',
                content: 'Apakah Anda yakin akan menghapus data ini?',
                icon: 'icon icon-question amber-text',
                theme: 'modern',
                closeIcon: true,
                animation: 'scale',
                type: 'red',
                buttons: {
                    ok: {
                        text: "ok!",
                        btnClass: 'btn-primary',
                        keys: ['enter'],
                        action: function() {
                            $.ajax({
                                url: $(e).data('url'),
                                type: "POST",
                                data: {
                                    '_method': 'DELETE',
                                    '_token': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(data) {
                                    table.api().ajax.reload();
                                },
                                error: function() {
                                    reload();
                                }
                            });
                        }
                    }
                }
            });
        }

        function resetForm() {
            $('#form').trigger('reset');
            $('#formTitle').html("Tambah");
            $('input[name=_method]').val('POST');
            $('#txtAction').html('');
            $('#btnReset').hide();
        }
    </script>
@endsection
