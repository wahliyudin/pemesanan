@extends('layouts.frontend.master')

@section('content')
    <!-- Start All Pages -->
    <div class="all-page-title page-breadcrumb">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Cart</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Pages -->

    <!-- Start Reservation -->
    <div class="reservation-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading-title text-center">
                        <h2>Cart</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12" style="position: relative;">
                    <div class="search-table-outter">
                        <table class="table table-light">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Photo</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $cart)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img style='border-radius: 10px;' src="{{ $cart->attributes->image }}"
                                                height="100" />
                                        </td>
                                        <td>{{ $cart->name }}</td>
                                        <td>Rp. {{ numberFormat($cart->price) }}</td>
                                        <td>
                                            <div class="d-flex align-items-center" style="gap: 5px;">
                                                <button class="decrement" data-qty="{{ $cart->quantity }}"
                                                    id="{{ Crypt::encrypt($cart->id) }}"
                                                    style="background-color: #dc3545; border: none; font-size: 30px; padding: 0; display: flex; color: white; border-radius: 5px; cursor: pointer;"><i
                                                        class='bx bx-minus'></i></button>
                                                <input type="number" readonly style="width: 50px; text-align: center;"
                                                    value="{{ $cart->quantity }}" id="qty">
                                                <button class="increment" id="{{ Crypt::encrypt($cart->id) }}"
                                                    style="background-color: #007bff; border: none; font-size: 30px; padding: 0; display: flex; color: white; border-radius: 5px; cursor: pointer;"><i
                                                        class='bx bx-plus'></i></button>
                                            </div>
                                        </td>
                                        <td>Rp. {{ numberFormat($cart->price * $cart->quantity) }}</td>
                                        <td>
                                            <button id="{{ Crypt::encrypt($cart->id) }}"
                                                class="btn btn-danger btn-xs delete">delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" align="right">Jumlah</td>
                                    <td>Rp. {{ numberFormat(Cart::getTotal()) }}</td>
                                    <td>
                                        @if (Cart::getTotal() != 0)
                                            <button class="btn btn-primary pesan">Pesan</button>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Reservation -->
@endsection
@push('css')
    <style>
        .search-table-outter {
            overflow-x: auto;
        }

        th,
        td {
            min-width: 150px;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endpush
@include('layouts.includes.toastr')
@push('script')
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
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
        $('body').on('click', '.delete', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Product akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Sekarang!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ env('APP_URL') }}/remove/" + $(this).attr('id'),
                        type: "GET",
                        dataType: "JSON",
                        success: function(resp) {
                            location.reload()
                            toastr.success(resp.message, 'Berhasil!');
                        },
                        error: ajaxError,
                    });
                }
            })
        });
        $('body').on('click', '.decrement', function(e) {
            e.preventDefault();
            console.log($(this).attr('id'));
            if ($(this).data('qty') == 1) {
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Product akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus Sekarang!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ env('APP_URL') }}/decrement/" + $(this).attr('id'),
                            type: "GET",
                            dataType: "JSON",
                            success: function(resp) {
                                location.reload()
                            },
                            error: ajaxError,
                        });
                    }
                })
            } else {
                $.ajax({
                    url: "{{ env('APP_URL') }}/decrement/" + $(this).attr('id'),
                    type: "GET",
                    dataType: "JSON",
                    success: function(resp) {
                        location.reload()
                    },
                    error: ajaxError,
                });
            }
        });

        $('body').on('click', '.increment', function(e) {
            e.preventDefault();
            console.log($(this).attr('id'));
            $.ajax({
                url: "{{ env('APP_URL') }}/increment/" + $(this).attr('id'),
                type: "GET",
                dataType: "JSON",
                success: function(resp) {
                    location.reload();
                },
                error: ajaxError,
            });
        });

        $('.pesan').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Product akan masuk kepesanan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Pesan Sekarang!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ route('customer.pesan') }}",
                        type: "GET",
                        dataType: "JSON",
                        success: function(resp) {
                            location.reload()
                            toastr.success(resp.message, 'Berhasil!');
                        },
                        error: ajaxError,
                    });
                }
            })
        });
    </script>
@endpush
