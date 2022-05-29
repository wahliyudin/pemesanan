@extends('layouts.backend.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="data-skip" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pesanan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>No Antrian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->kode_pesanan }}</td>
                                        <td>{{ $order->tanggal }}</td>
                                        <td>{!! $order->status !!}</td>
                                        <td>{{ numberFormat($order->total) }}</td>
                                        <td>{{ $order->no_antrian }}</td>
                                        <td>
                                            <button id="{{ Crypt::encrypt($order->id) }}"
                                                class="restore btn btn-primary btn-sm">Restore</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('layouts.includes.datatables')
@include('layouts.includes.toastr')
@push('script')
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(function() {
            $("#data-skip").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#data-skip_wrapper .col-md-6:eq(0)');
        });
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

        $('body').on('click', '.restore', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ env('APP_URL') }}/admin/transaksi/restore/" + $(this).attr('id'),
                type: "GET",
                dataType: "JSON",
                success: function(resp) {
                    location.reload()
                    toastr.success(resp.message, 'Berhasil!');
                },
                error: ajaxError,
            });
        });
    </script>
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endpush
