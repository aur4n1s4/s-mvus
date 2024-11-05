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
                <div class="col-md-12 p-2">
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
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Telepon</th>
                                        <th>Tanggal Lahir</th>
                                        <th width="60"></th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
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
                    data: 'nik',
                    name: 'nik'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'telepon',
                    name: 'telepon'
                },
                {
                    data: 't_lahir',
                    name: 't_lahir',
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
    </script>
@endsection
