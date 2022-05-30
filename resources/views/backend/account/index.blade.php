@extends('layouts.backend.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Akun Rekening</h3>
                        <button class="btn btn-sm btn-primary float-right" onclick="tambahAccount()"><i
                                class="fas fa-plus mr-2"></i>
                            Tambah
                            Data</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="account" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
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
    @include('backend.account.modals')
@endsection
@include('layouts.includes.datatables')
@include('layouts.includes.toastr')
@push('script')
    <script type="text/javascript">
        var table;
        setTimeout(function() {
            tableAccount();
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
        function tableAccount() {
            $('#account').dataTable().fnDestroy();
            table = $('#account').DataTable({
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('api.accounts.index') }}",
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
                        data: 'code',
                        name: 'code'
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
        function tambahAccount() {
            $('#modal-store').modal('show');
            $('#nama').val('');
            $('#code').val('');
            $('#btn-store-account').prop('disabled', false);
        }

        function storeAccount() {
            let nama = $('#nama').val();
            let code = $('#code').val();

            if (!nama) {
                toastr.warning('Nama akun tidak boleh kosong!', 'Peringatan!');
                return false;
            }
            if (!code) {
                toastr.warning('Code akun tidak boleh kosong!', 'Peringatan!');
                return false;
            }

            $('#btn-store-account').prop('disabled', true);
            var type = 'POST';
            var url = "{{ route('api.accounts.store') }}";
            $.ajax({
                url: url,
                type: type,
                data: $('#form-account').serialize(),
                success: function(data) {
                    $('#modal-store').modal('hide');
                    toastr.success(data.message, 'Berhasil!');
                    table.ajax.reload();
                },
                error: ajaxError,
                complete: function() {
                    $('#btn-store-account').prop('disabled', false);
                },
            });
        }

        // Edit Data
        $('body').on('click', '.edit', function(e) {
            e.preventDefault();
            editAccount($(this).attr('id'))
        });

        function editAccount(id) {
            $.ajax({
                url: "{{ env('APP_URL') }}/api/accounts/" + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(resp) {
                    $('#modal-update').modal('show');
                    $('#account_id').val(resp.data.id);
                    $('#nama_update').val(resp.data.nama);
                    $('#code_update').val(resp.data.code);
                    $('#btn-update-account').prop('disabled', false);
                },
                error: ajaxError,
            });
        }

        function updateAccount() {
            let nama = $('#nama_update').val();
            let code = $('#code_update').val();
            if (!nama) {
                toastr.warning('Nama akun tidak boleh kosong!', 'Peringatan!');
                return false;
            }
            if (!code) {
                toastr.warning('Nama akun tidak boleh kosong!', 'Peringatan!');
                return false;
            }

            let id = $('#account_id').val();
            $('#btn-update-account').prop('disabled', true);
            $.ajax({
                url: "{{ env('APP_URL') }}/api/accounts/" + id + "/update",
                type: 'PUT',
                data: $('#form-update-account').serialize(),
                success: function(resp) {
                    $('#modal-update').modal('hide');
                    toastr.success(resp.message, 'Berhasil!');
                    table.ajax.reload();
                },
                error: ajaxError,
                complete: function() {
                    $('#btn-update-account').prop('disabled', false);
                },
            });

        }

        // delete
        $('body').on('click', '.delete', function(e) {
            e.preventDefault();
            deleteAccount($(this).attr('id'))
        });

        function deleteAccount(id) {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Akun Rekening akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Sekarang!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ env('APP_URL') }}/api/accounts/" + id + "/destroy",
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
