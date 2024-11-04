@extends('layouts.app')

@section('title', 'Data Role')

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
                            <i class="icon icon-clipboard-list2"></i> Data Permissions '{{ $role->name }}'
                        </h4>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <ul class="nav nav-material nav-material-white responsive-tab" id="v-pegawai-tab" role="tablist">
                        <li>
                            <a class="nav-link" href="javascript:history.back()">
                                <i class="icon icon-arrow_back"></i>Kembali</a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="container-fluid my-3">
            <div class="card no-b">
                <div class="card-body">
                    <div id="formPermission">
                        <div id="alert"></div>
                        <div class="row">
                            <div class="col-6">
                                <form class="needs-validation" id="form" method="POST" novalidate>
                                    @csrf
                                    {{ method_field('POST') }}
                                    <input type="hidden" id="id" name="id" value="{{ $role->id }}" />
                                    <div class="form-row form-inline">
                                        <div class="col-md-12">

                                            <div class="form-group m-0">
                                                <label for="permission"
                                                    class="col-form-label s-12 col-md-3">Permission</label>
                                                <div class="col-md-9">
                                                    <select name="permissions[]" id="permission" placeholder=""
                                                        class="select2 form-control r-0 light s-12" multiple="multiple"
                                                        required>
                                                        @foreach ($permissions as $key => $permission)
                                                            <option value="{{ $permission->name }}">{{ $permission->name }}
                                                            </option>
                                                        @endforeach
                                                        <select>
                                                </div>
                                            </div>

                                            <div class="card-body offset-md-3">
                                                <button type="submit" class="btn btn-primary btn-sm" id="action2"><i
                                                        class="icon-save mr-2"></i>Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-6">
                                <strong>List Permission:</strong>
                                <ol id="viewPermission" class=""></ol>
                            </div>
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
    <script src="{{ asset('backend/js/jquery-fancybox.min.js') }}"></script>

    {{-- INITIALIZE --}}
    <script type="text/javascript">
        $(document).ready(function() {
            getPermissions();
        })
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
                url = "{{ route($route . 'permission.store') }}";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: new FormData($(this)[0]),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#action').removeAttr('disabled');
                        if (data.success == 1) {
                            $('#alert').html(
                                "<div role='alert' class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Success!</strong> " +
                                data.message + "</div>");
                            getPermissions();
                        }
                    },
                    error: function(data) {
                        $('#action').removeAttr('disabled');
                        err = '';
                        respon = data.responseJSON;
                        $.each(respon.errors, function(index, value) {
                            err = err + "<li>" + value + "</li>";
                        });

                        $('#alert').html(
                            "<div role='alert' class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Error!</strong> " +
                            respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
                    }
                });
                return false;
            }
            $(this).addClass('was-validated');
        });
    </script>

    {{-- DESTROY --}}
    <script type="text/javascript">
        function removePermission(name) {
            $.confirm({
                title: '',
                content: 'Apakah Anda yakin akan menghapus role ini?',
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
                                url: "{{ route($route . 'permission.destroy', ':name') }}".replace(
                                    ':name', name),
                                type: "POST",
                                data: {
                                    '_method': 'DELETE',
                                    '_token': csrf_token,
                                    'id': $('#id').val()
                                },
                                success: function(data) {
                                    getPermissions();
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
        function getPermissions() {
            $('#viewPermission').html("Loading...");
            urlPermission = "{{ route($route . 'permission.listPermission', ':id') }}".replace(':id', $('#id').val());
            $.get(urlPermission, function(data) {
                $('#viewPermission').html("");
                if (data.length > 0) {
                    $.each(data, function(index, value) {
                        val = "'" + value.name + "'";
                        $('#viewPermission').append('<li>' + value.name +
                            ' <a href="#" onclick="removePermission(' + val +
                            ')" class="text-danger" title="Hapus Data"><i class="icon-remove"></i></a></li>'
                            );
                    });
                } else {
                    $('#viewPermission').html("<em>Data role kosong.</em>");
                }
            });
        }
    </script>
@endsection
