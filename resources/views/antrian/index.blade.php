@extends('layouts.app')

@section('title', $title)

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-fancybox.min.css') }}">

    <style>
        .select2-selection__rendered {
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-results__option[data-badge="primary"] {
            color: #fff;
            background-color: #007bff;
            padding: 2px 8px;
            border-radius: 12px;
        }

        .select2-container--default .select2-results__option[data-badge="warning"] {
            color: #fff;
            background-color: #ffc107;
            padding: 2px 8px;
            border-radius: 12px;
        }

        .select2-container--default .select2-results__option[data-badge="success"] {
            color: #fff;
            background-color: #28a745;
            padding: 2px 8px;
            border-radius: 12px;
        }
    </style>
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
                            <form id="form-filter">
                                @csrf
                                @method('POST')

                                <div class="row col-md-12 mt-2 mb-5">

                                    <div class="col-md-1 p-1">
                                        <div class="mt-3 ml-2 float-right">
                                            <strong><i class="icon-filter"></i> FILTER </strong>
                                        </div>
                                    </div>

                                    <div class="column col-md-10">
                                        <div class="form-row m-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="f-poli" class="col-form-label s-12">
                                                        Poliklinik
                                                    </label>
                                                    <select name="f-poli" id="f-poli"
                                                        class="form-control r-0 s-12 filter">
                                                        @foreach ($polis as $poli)
                                                            <option value="{{ $poli->id }}">{{ $poli->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="f-tanggal" class="col-form-label s-12">Tanggal</label>
                                                    <div class="input-group">
                                                        <input name="f-tanggal"
                                                            class="form-control r-0 s-12 date-time-picker filter"
                                                            id="f-tanggal" placeholder="Dari tanggal"
                                                            value="{{ date('Y-m-d') }}" style="height: 39px" />
                                                        <span class="input-group-append">
                                                            <span class="input-group-text add-on white">
                                                                <i class="icon-calendar"></i>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-1 p-1">
                                        <div class="form-group">
                                            <label class="col-form-label">&nbsp;</label>
                                            <a class="form-control btn btn-danger btn-sm m-2 reset" title="Reset Filter">
                                                <i class="icon-trash mr-1"></i>Reset
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table id="table" class="table table-striped" style="width:100%"
                                    data-url="{{ route($route . 'api') }}">
                                    <thead>
                                        <th width="30">No</th>
                                        <th>Nama</th>
                                        <th>Jaminan</th>
                                        <th>Nomor HP</th>
                                        <th>Poliklinik</th>
                                        <th>Antrian</th>
                                        <th>Status</th>
                                        <th>Panggil</th>
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
        $(document).ready(function() {
            $('#f-tanggal').datetimepicker({
                format: 'Y-m-d',
                timepicker: false,
                datepicker: true,
                scrollInput: false
            });

            $(document).on('change', '.filter', function() {
                table.fnFilter();
            });
        });

        var table = $('#table').dataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: $('#table').data('url'),
                data: function(data) {
                    data.poli = $('#f-poli').val();
                    data.tanggal = $('#f-tanggal').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    align: 'center',
                    className: 'text-center'
                },
                {
                    data: 'pengunjung.nama',
                    name: 'pengunjung.nama',
                },
                {
                    data: 'jaminan',
                    name: 'faskes'
                },
                {
                    data: 'pengunjung.telepon',
                    name: 'pengunjung.telepon'
                },
                {
                    data: 'poli.nama',
                    name: 'poli.nama'
                },
                {
                    data: 'no_antrian',
                    name: 'no_antrian'
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'call_pasien',
                    name: 'call_pasien',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                }
            ]
        });

        $(document).on('change', '#status', function() {
            $.ajax({
                url: $(this).data('url'),
                type: 'POST',
                data: {
                    'status': $(this).val(),
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    table.api().ajax.reload();
                },
                error: function() {
                    reload();
                }
            });
        });

        function panggilPasien(text) {
            const utterance = new SpeechSynthesisUtterance(text);
            speechSynthesis.speak(utterance);
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
    </script>
@endsection
