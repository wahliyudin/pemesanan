@extends('layouts.frontend.master')

@section('content')
    <!-- Start All Pages -->
    <div class="all-page-title page-breadcrumb">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Detail Pesanan</h1>
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
                        <h2>Detail Pesanan</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-2">
                    <div class="row">
                        <div class="col-md-6">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Kode Pesanan</td>
                                        <td style="min-width: 10px;">:</td>
                                        <td>{{ $order->kode_pesanan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td style="min-width: 10px;">:</td>
                                        <td>{{ $order->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>No Telp</td>
                                        <td style="min-width: 10px;">:</td>
                                        <td>{{ $order->user->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td style="min-width: 10px;">:</td>
                                        <td>{{ $order->user->email }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 text-right d-flex flex-column justify-content-between align-items-end">
                            {!! $order->status !!}
                            <span style="font-size: 25px; font-weight: 600;">{{ $order->no_antrian }}</span>
                            <span>{{ \Carbon\Carbon::make($order->created_at)->isoFormat('LLLL') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12 col-xs-12" style="position: relative;">
                    <div class="search-table-outter">
                        <table class="table table-light">
                            <thead class="thead-light">
                                <tr>
                                    <th style="min-width: 10px !important;">No</th>
                                    <th>Photo</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->products as $product)
                                    <tr>
                                        <td style="min-width: 10px !important;">{{ $loop->iteration }}</td>
                                        <td>
                                            <img style='border-radius: 10px;' src="{{ $product->photo }}" height="100" />
                                        </td>
                                        <td>{{ $product->nama }}</td>
                                        <td>Rp. {{ numberFormat($product->harga) }}</td>
                                        <td>{{ $product->pivot->qty }}</td>
                                        <td>Rp. {{ numberFormat($product->pivot->total) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" align="right">Jumlah</td>
                                    <td>Rp. {{ numberFormat($order->products->sum('pivot.total')) }}</td>
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
@endpush
