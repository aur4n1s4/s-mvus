@extends('layouts.app')

@section('title', $title)

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-confirm.min.css') }}">
@endsection

@section('content')
    <div class="page has-sidebar-left bg-light">
        <header class="blue accent-3 relative nav-sticky">
            <div class="container-fluid text-white">
                <div class="row">
                    <div class="col">
                        <h3 class="my-2">
                            <i class="icon icon-clipboard-list2"></i> {{ $subTitle }}
                        </h3>
                    </div>
                </div>
            </div>
        </header>
        <div class="container-fluid my-3">
            <div role="alert" class="alert alert-warning">
                <strong>Manual cache reset!</strong> php artisan cache:forget spatie.permission.cache
            </div>

            <div class="row">
                <div class="col-md-8 p-2">
                    <div class="card">
                        <div class="card-header">
                            <h6>
                                <strong>
                                    Tabel - {{ $subTitle }}
                                </strong>
                            </h6>
                        </div>

                        <div class="card-body no-b">
                            <div class="table-responsive">
                                <table id="permission-table" class="table table-striped" style="width:100%">
                                    <thead>
                                        <th width="30">No</th>
                                        <th>Nama</th>
                                        <th width="80">Guard Name</th>
                                        <th width="40"></th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 p-2">
                    <div id="alert"></div>
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-10">
                                    <h6>
                                        <strong>
                                            <span id="formTitle">Tambah {{ $subTitle }}</span>
                                        </strong>
                                    </h6>
                                </div>
                                <div class="col-md-2" style="display: none; " id="btnReset">
                                    <a href='#' onclick='resetForm()' class='btn btn-outline-primary btn-xs'>Batal</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" id="form" method="POST" novalidate>
                                @csrf
                                {{ method_field('POST') }}
                                <input type="hidden" id="id" name="id" />
                                <div class="form-row form-inline">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12 col-md-4">
                                                Nama
                                            </label>
                                            <input type="text" name="name" id="name"
                                                class="form-control r-0 light s-12 col-md-8" autocomplete="off" required />
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="guard_name" class="col-form-label s-12 col-md-4">
                                                Guard Name
                                            </label>
                                            <input type="text" name="guard_name" id="guard_name"
                                                class="form-control r-0 light s-12 col-md-8" autocomplete="off" required />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="float-right">
                                            <button type="submit" class="btn btn-primary btn-sm" id="action">
                                                <i class="icon-save mr-2"></i>
                                                Simpan
                                                <span id="txtAction"></span>
                                            </button>
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
    {{-- LIBRARY --}}
    <script src="{{ asset('backend/js/jquery-confirm.min.js') }}"></script>

    {{-- INITIALIZE --}}
    <script type="text/javascript">
        var method = 'add';
        var table;
    </script>

    {{-- TABEL --}}
    <script type="text/javascript">
        table = $('#permission-table').dataTable({
            processing: true,
            serverSide: true,
            order: [1, 'asc'],
            ajax: "{{ route($route . 'api') }}",
            columns: [{
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false,
                    align: 'center',
                    className: 'text-center'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'guard_name',
                    name: 'guard_name'
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

        table.on('draw.dt', function() {
            var PageInfo = $('#permission-table').DataTable().page.info();
            table.api().column(0, {
                page: 'current'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            });
        });
    </script>

    {{-- STORE || UPDATE --}}
    <script type="text/javascript">
        $('#form').on('submit', function(e) {
            if ($(this)[0].checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                $('#alert').html('');
                $('#action').attr('disabled', true);;
                if (method == 'add') {
                    url = "{{ route($route . 'store') }}";
                } else {
                    url = "{{ route($route . 'update', ':id') }}".replace(':id', $('#id').val());
                }
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: new FormData($(this)[0]),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#action').removeAttr('disabled');
                        $('#alert').html(
                            "<div role='alert' class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Success!</strong> " +
                            data + "</div>");

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
    </script>

    {{-- EDIT --}}
    <script type="text/javascript">
        function edit(id) {
            method = 'edit';
            $('#alert').html('');
            $('#form').trigger('reset');
            $('#formTitle').html("Mohon tunggu beberapa saat...");
            $('#txtAction').html(" Perubahan");
            $('#reset').hide();
            $('input[name=_method]').val('PATCH');
            $('#btnReset').show();
            $.ajax({
                url: "{{ route($route . 'edit', ':id') }}".replace(':id', id),
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#formTitle').html("Edit - {{ $subTitle }}");
                    $('#id').val(data.id);
                    $('#name').val(data.name).focus();
                    $('#guard_name').val(data.guard_name);
                },
                error: function() {
                    console.log("Nothing Data");
                    reload();
                }
            });
        }
    </script>

    {{-- DESTROY --}}
    <script type="text/javascript">
        function remove(id) {
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
                            var csrf_token = $('meta[name="csrf-token"]').attr('content');
                            $.ajax({
                                url: "{{ route($route . 'destroy', ':id') }}".replace(':id', id),
                                type: "POST",
                                data: {
                                    '_method': 'DELETE',
                                    '_token': csrf_token
                                },
                                success: function(data) {
                                    table.api().ajax.reload();
                                },
                                error: function() {
                                    console.log('Opssss...');
                                    reload();
                                }
                            });
                        }
                    },
                    cancel: function() {
                        console.log('the user clicked cancel');
                    }
                }
            });
        }
    </script>

    {{-- UTILS --}}
    <script type="text/javascript">
        function resetForm() {
            method = "add";
            $('#form').trigger('reset');
            $('#formTitle').html("Tambah {{ $subTitle }}");
            $('input[name=_method]').val('POST');
            $('#txtAction').html('');
            $('#btnReset').hide();
        }
    </script>
@endsection
