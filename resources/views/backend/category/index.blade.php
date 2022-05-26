@extends('layouts.backend.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Kategori</h3>
                        <button class="btn btn-sm btn-primary float-right" onclick="tambahCategory()"><i
                                class="fas fa-plus mr-2"></i>
                            Tambah
                            Data</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="category" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-store">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-category">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" value="{{ old('nama') }}" name="nama" id="nama"
                                placeholder="Nama">
                            <span class="text-danger" id="namaError"></span>
                        </div>
                        <button type="button" onclick="storeCategory()" class="btn btn-primary"
                            id="btn-store-category">Simpan</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="modal-update">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-update-category">
                        @csrf
                        <input type="hidden" class="d-none" name="category_id" id="category_id" readonly>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama_update" id="nama_update"
                                placeholder="Nama">
                            <span class="text-danger" id="namaError"></span>
                        </div>
                        <button type="button" onclick="updateCategory()" class="btn btn-primary"
                            id="btn-update-category">Update</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
{{-- @include('layouts.inc.tosatr') --}}
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@push('script')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    {{-- <script>
        $(function() {
            var table = $('#category').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('api.categories') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
        });

        $(document).ready(function() {
            $("form").submit(function(event) {
                let nama = $("input[name=nama]").val();
                let _token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('admin.categories.store') }}",
                    type: "POST",
                    data: {
                        nama: nama,
                        _token: _token
                    },
                    success: function(response) {
                        console.log(response);
                        table.ajax.reload();
                        $('#modal-store').modal('toggle');
                        $("input[name=nama]").val('');
                        toastr.success(response.message, 'Berhasil!');
                    },
                    error: function(response) {
                        $('#namaError').text(response.responseJSON.errors.nama);
                    }
                });

                event.preventDefault();
            });
        });
    </script> --}}
    {{-- <script>
        function submitForm() {
            let nama = $("input[name=nama]").val();
            let _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/contact",
                type: "POST",
                data: {
                    nama: nama,
                    _token: _token
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(response) {
                    $('#namaError').text(response.responseJSON.errors.nama);
                }
            });

        }
    </script> --}}
    <script type="text/javascript">
        var table;
        setTimeout(function() {
            tableCategory();
        }, 500);
        var ajaxError = function(jqXHR, xhr, textStatus, errorThrow, exception) {
            if (jqXHR.status === 0) {
                toastr.error('Not connect.\n Verify Network.', 'Error!');
            } else if (jqXHR.status == 400) {
                toastr.warning(jqXHR['responseJSON'].message, 'Peringatan!');
            } else if (jqXHR.status == 404) {
                toastr.error('Requested page not found. [404]', 'Error!');
            } else if (jqXHR.status == 500) {
                toastr.error('Internal Server Error [500].' + jqXHR['responseJSON'].message, 'Error!');
            } else if (exception === 'parsererror') {
                toastr.error('Requested JSON parse failed.', 'Error!');
            } else if (exception === 'timeout') {
                toastr.error('Time out error.', 'Error!');
            } else if (exception === 'abort') {
                toastr.error('Ajax request aborted.', 'Error!');
            } else {
                toastr.error('Uncaught Error.\n' + jqXHR.responseText, 'Error!');
            }
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // function to retrieve DataTable server side
        function tableCategory() {
            $('#category').dataTable().fnDestroy();
            table = $('#category').DataTable({
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('api.categories.index') }}",
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ],
                pageLength: 10,
                lengthMenu: [
                    [10, 20, 50, -1],
                    [10, 20, 50, 'All']
                ]
            });
        }

        // Add Data
        function tambahCategory() {
            $('#modal-store').modal('show');
            $('#nama').val('');
            $('#btn-store-category').prop('disabled', false);
        }

        function storeCategory() {
            let nama = $('#nama').val();

            if (!nama) {
                toastr.warning('Nama category tidak boleh kosong!', 'Peringatan!');
                return false;
            }

            $('#btn-store-category').prop('disabled', true);
            var type = 'POST';
            var url = "{{ route('api.categories.store') }}";
            $.ajax({
                url: url,
                type: type,
                data: $('#form-category').serialize(),
                success: function(data) {
                    $('#modal-store').modal('hide');
                    toastr.success(data.message, 'Berhasil!');
                    table.ajax.reload();
                },
                error: ajaxError,
                complete: function() {
                    $('#btn-store-category').prop('disabled', false);
                },
            });
        }

        $('body').on('click', '.edit', function(e) {
            e.preventDefault();
            editCategory($(this).attr('id'))
        });
        // Edit Data
        function editCategory(id) {
            $.ajax({
                url: "{{ env('APP_URL') }}/api/categories/" + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(resp) {
                    $('#modal-update').modal('show');
                    $('#category_id').val(resp.data.id);
                    $('#nama_update').val(resp.data.nama);
                    $('#btn-update-category').prop('disabled', false);
                },
                error: ajaxError,
            });
        }

        function updateCategory() {
            let nama = $('#nama_update').val();
            if (!nama) {
                toastr.warning('Nama category tidak boleh kosong!', 'Peringatan!');
                return false;
            }

            let id = $('#category_id').val();
            $('#btn-update-category').prop('disabled', true);
            $.ajax({
                url: "{{ env('APP_URL') }}/api/categories/" + id + "/update",
                type: 'PUT',
                data: $('#form-update-category').serialize(),
                success: function(resp) {
                    $('#modal-update').modal('hide');
                    toastr.success(resp.message, 'Berhasil!');
                    table.ajax.reload();
                },
                error: ajaxError,
                complete: function() {
                    $('#btn-update-category').prop('disabled', false);
                },
            });

        }

        $('body').on('click', '.delete', function(e) {
            e.preventDefault();
            deleteCategory($(this).attr('id'))
        });
        // delete
        function deleteCategory(id) {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Category akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Sekarang!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ env('APP_URL') }}/api/categories/" + id + "/destroy",
                        type: 'DELETE',
                        success: function(resp) {
                            toastr.success(resp.message, 'Berhasil!');
                            table.ajax.reload();
                        },
                        error: ajaxError,
                    });
                }
            })
        }
    </script>
@endpush
@include('layouts.includes.toastr')
