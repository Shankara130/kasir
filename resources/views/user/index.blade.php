@extends('layout/app-layout')
@section('title')
    <title>User</title>
@endsection
@section('sisipancss')
@endsection
@section('sisipanjs')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
@endsection
@section('breadcrumb')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Data produk</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Data User</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('mainpage')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="btn-group">
                        <button onclick="addForm('{{ route('user.store') }}')" class="btn btn-success btn-xs btn-flat"><i
                                class="fa fa-plus-circle"></i> Tambah</button>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <form action="" method="post" class="form-user" enctype="multipart/form-data">
                        @csrf
                        <table class="table table-stiped table-bordered">
                            <thead>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th width="15%"><i class="fa fa-cog"></i></th>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @includeIf('user.form')
@endsection

@push('scripts')
    <script>
        let table;

        $(function() {
            table = $('.table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('user.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'level'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]
            });

            // VALIDASI SIMPAN
            $('#form-store').validate({
                submitHandler: function(form) {
                    $.ajax({
                        url: $(form).attr('action'),
                        method: 'POST',
                        data: new FormData(form),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            alert('Data berhasil disimpan!');
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                        },
                        error: function(xhr) {
                            alert('Tidak dapat menyimpan data.');
                            console.log(xhr.responseText);
                        }
                    });
                }
            });

            // VALIDASI UPDATE
            $('#form-edit').validate({
                submitHandler: function(form) {
                    $.ajax({
                        url: $(form).attr('action'),
                        method: 'POST', // Tetap POST, Laravel baca _method=PUT
                        data: new FormData(form),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            alert('Data berhasil diupdate!');
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                        },
                        error: function(xhr) {
                            alert('Tidak dapat mengupdate data.');
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah User');

            $('#form-store').show();
            $('#form-edit').hide();

            $('#form-store')[0].reset();
            $('#form-store').attr('action', url);
            $('#form-store [name=_method]').val('post');
            $('#form-store [name=name]').focus();

            $('##form-store').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    }
                });

            });
        }

        function hideModalForm() {
            $('#modal-form').modal('hide');
            $('#modal-form form')[0].reset();
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit User');

            $('#form-store').hide();
            $('#form-edit').show();

            $('#form-edit')[0].reset();
            $('#form-edit').attr('action', url);
            $('#form-edit [name=_method]').val('put');
            $('#form-edit [name=name]').focus();

            $('#form-edit').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    }
                });

            });

            $.get(url)
                .done((response) => {
                    $('#form-edit [name=name]').val(response.name);
                    $('#form-edit [name=email]').val(response.email);
                    $('#form-edit [name=level]').val(response.level);
                })
                .fail(() => {
                    alert('Tidak dapat menampilkan data');
                });
        }

        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        }

        function deleteSelected(url) {
            if ($('input:checked').length > 1) {
                if (confirm('Yakin ingin menghapus data terpilih?')) {
                    $.post(url, $('.form-produk').serialize())
                        .done((response) => {
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            alert('Tidak dapat menghapus data');
                            return;
                        });
                }
            } else {
                alert('Pilih data yang akan dihapus');
                return;
            }
        }
    </script>
@endpush
