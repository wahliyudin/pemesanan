<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            padding: 0;
            margin: 0;
        }

        table {
            font-family: verdana, arial, sans-serif;
            font-size: 11px;
            color: #333333;
            border-width: none;
            /*border-color: #666666;*/
            border-collapse: collapse;
            width: 100%;
        }

        th {
            padding-bottom: 8px;
            padding-top: 8px;
            background-color: #dedede;
            /*border-bottom: solid;*/
            text-align: left;
        }

        td {
            text-align: left;
            border-color: #666666;
            background-color: #ffffff;
            line-height: 20px;
        }

    </style>
</head>

<body style="padding: 0 20px;">
    <header style="text-align: center; padding: 10px 0;">
        <h2>Mie Jablay</h2>
        <h2 style="color: blue;">Bukti Transaksi</h2>
    </header>
    <table>
        <tr>
            <th style="padding: 0 0 0 5px;">No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Total</th>
        </tr>
        {{-- @foreach ($payments as $payment)
            <tr>
                <td style="padding: 0 0 0 5px;"></td>
                <td>
                    {{ \Carbon\Carbon::make($payment->tanggal)->format('d/m/Y') }}
                </td>
                <td>
                    Pembayaran {{ $payment->no_pembayaran }}
                </td>
            </tr>
            <tr>
                <td style="padding: 0 0 0 5px;">{{ $loop->iteration }}</td>
                <td>
                    {{ $payment->no_pembayaran }}
                </td>
                <td>
                    {{ $payment->account->code . ' ' . $payment->account->nama }}
                </td>
                <td>
                    Rp. {{ numberFormat($payment->tagihan) }}
                </td>
                <td></td>
            </tr>
            <tr>
                <td style="padding: 0 0 0 5px; border-bottom: 1px solid;"></td>
                <td style="border-bottom: 1px solid;">
                    {{ $payment->no_pembayaran }}
                </td>
                <td style="border-bottom: 1px solid;">
                    {{ $payment->account->code . ' ' . $payment->account->nama }}
                </td>
                <td style="border-bottom: 1px solid;"></td>
                <td style="border-bottom: 1px solid;">
                    Rp. {{ numberFormat($payment->tagihan) }}
                </td>
            </tr>
        @endforeach --}}
    </table>
</body>

</html>
