<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Kwitansi Pembayaran | {{ config('app.name', 'Laravel') }}</title>


    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: left;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 0.2rem;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

        .nama {
            text-transform: capitalize;
        }

        .download-pdf {
            background-color: #ff3e1d;
            /* Green */
            border: none;
            border-radius: 8px;
            color: white;
            padding: 0.5rem 0.8rem;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
        }

        .cetak {
            background-color: #079229;
            /* Green */
            border: none;
            border-radius: 8px;
            color: white;
            padding: 0.5rem 0.8rem;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
        }

        .tombol {
            margin-top: 1rem;
        }

        table tr td {
            border-bottom: 1px solid black;
        }

    </style>
</head>

<body>
    <div style="margin: auto;">
        <div class="invoice-box ">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td width="30%">No.</td>
                    <td>: #{{ $pembayaran->id }}</td>
                </tr>
                <tr>
                    <td>Telah terima dari</td>
                    <td>: {{ ucwords($pembayaran->tagihan->santri->nama) }}</td>
                </tr>
                <tr>
                    <td>Uang sejumlah</td>
                    <td>: <i>{{ ucwords(terbilang($pembayaran->jumlah_dibayar)) }} Rupiah</i></td>
                </tr>
                <tr>
                    <td>Untuk pembayaran</td>
                    <td>: SPP Bulan {{ $pembayaran->tagihan->tanggal_tagihan->translatedFormat('F Y') }}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <table>
                        <tr>
                            <td colspan="2" style="vertical-align: middle;text-align:center;font-weight: bold;font-size:1.5rem" width="300">
                                <div style="background: #eee;width:150px;padding:1.6rem">{{ formatRupiah($pembayaran->jumlah_dibayar) }}</div>
                            </td>
                            <td style="text-align: center">
                                Ngujur,{{ now()->translatedFormat('d, F Y') }} <br>
                                Ttd <br>
                                <br>
                                <br>
                                <br>
                                Bendahara
                            </td>
                        </tr>
                    </table>
                </tr>

                {{-- <tr class="total">
                <td>Total Tagihan</td>

                <td>{{ formatRupiah($tagihan->total_tagihan) }}</td>
                </tr> --}}
            </table>
            <div class="tombol">
                <a href="{{ url()->current() . '?output=pdf' }}" class="download-pdf">Download PDF</a>
                <a href="#" onclick="window.print()" class="cetak">Cetak</a>
            </div>
        </div>
    </div>
</body>
</html>
