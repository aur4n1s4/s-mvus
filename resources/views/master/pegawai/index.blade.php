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
                        <h4>
                            <i class="icon icon-users"></i> Data {{ $subTitle }}
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <ul class="nav nav-material nav-material-white responsive-tab">
                        <li>
                            <a class="nav-link" href="{{ route($route . 'create') }}">
                                <i class="icon icon-add"></i>Tambah Data</a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <div class="container-fluid my-3">
            <div class="row">
                <!-- Start Table -->
                <div class="col-md-12 p-2">
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
                                <table id="employee-table" class="table table-striped"
                                    data-url="{{ route($route . 'list') }}" style="width:100%">
                                    <thead>
                                        <th width="30">No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telp</th>
                                        <th width="120">Pengguna APP</th>
                                        <th width="40"></th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Table -->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- LIBRARY  -->
    <script src="{{ asset('backend/js/jquery-fancybox.min.js') }}"></script>
    <script src="{{ asset('backend/js/jquery-confirm.min.js') }}"></script>

    <!-- INITIALIZE -->
    <script type="text/javascript">
        var table = $('#employee-table');
    </script>

    <!-- TABLE -->
    <script type="text/javascript">
        table.dataTable({
            processing: true,
            serverSide: true,
            order: [2, 'asc'],
            ajax: table.data('url'),
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
                {
                    name: 'nik',
                    data: 'nik',
                },
                {
                    name: 'full_name',
                    data: 'full_name'
                },
                {
                    name: 'email',
                    data: 'email'
                },
                {
                    name: 'phone_number',
                    data: 'phone_number'
                },
                {
                    data: 'user',
                    name: 'user'
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
    </script>

    <!-- DESTROY -->
    <script type="text/javascript">
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
                    },
                }
            });
        }
    </script>

    <!-- PENGAJUAN ULANG -->
    <script type="text/javascript">
        function addUser(e) {
            $.confirm({
                title: '',
                content: 'Apakah Anda yakin akan menambahkan pegawai ini sebagai user?',
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
                                url: $(e).data('url'),
                                type: "POST",
                                data: {
                                    '_method': 'POST',
                                    '_token': csrf_token
                                },
                                success: function(data) {
                                    table.api().ajax.reload();
                                },
                                error: function() {
                                    reload();
                                }
                            });
                        }
                    },
                }
            });
        }
    </script>
@endsection
