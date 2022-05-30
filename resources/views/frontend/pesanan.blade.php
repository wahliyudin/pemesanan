@extends('layouts.frontend.master')

@section('content')
    <!-- Start All Pages -->
    <div class="all-page-title page-breadcrumb">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Pesanan</h1>
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
                        <h2>Pesanan</h2>
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
                                    <th style="min-width: 10px !important;">No</th>
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
                                        <td style="min-width: 10px !important;">{{ $loop->iteration }}</td>
                                        <td>{{ $order->kode_pesanan }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::make($order->created_at)->isoFormat('LLLL') }}
                                        </td>
                                        <td>{!! $order->status !!}</td>
                                        <td>Rp. {{ numberFormat($order->total) }}</td>
                                        <td>
                                            <span
                                                style="font-size: 25px; font-weight: 600;">{{ $order->no_antrian }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('customer.order.detail', Crypt::encrypt($order->id)) }}"
                                                class="btn btn-secondary btn-xs">detail</a>
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
@endpush
@push('script')
    <script src="/js/app.js"></script>
    <script>
        window.Echo.channel("payment").listen("PaymentCreated", (event) => {
            location.reload();
            Notification.requestPermission(permission => {
                let notification = new Notification('New category alert!', {
                    body: event.message, // content for the alert
                    icon: "{{ asset('frontend/images/logo.png') }}" // optional image url
                });

                // link to page on clicking the notification
                notification.onclick = () => {
                    window.open(window.location.href);
                };
            })

        });
        window.Echo.channel("order").listen("OrderSkip", (event) => {
            location.reload();
            Notification.requestPermission(permission => {
                let notification = new Notification('New category alert!', {
                    body: event.message, // content for the alert
                    icon: "{{ asset('frontend/images/logo.png') }}" // optional image url
                });

                // link to page on clicking the notification
                notification.onclick = () => {
                    window.open(window.location.href);
                };
            })

        });
    </script>
@endpush
