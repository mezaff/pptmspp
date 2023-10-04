<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Kartu SPP | {{ config('app.name', 'Laravel') }}</title>


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
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
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

        .table-tagihan {
            border-collapse: collapse;
        }

        .table-tagihan th,
        .table-tagihan td {
            border: 1px solid black;
            padding: 0.5rem;
        }

        .table-tagihan th {
            background-color: #eee;
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

    </style>
</head>

<body>
    <div style="margin: auto;">
        <div class="invoice-box ">
            <table>
                <tr>
                    <td width="3%"></td>
                    <td class="text-end">
                        @if (request('output') == 'pdf')
                        <img src="{{ storage_path() . '/app/' . settings()->get('app_logo') }}" alt="" width="100">
                        @else
                        <img src="{{ asset(\Storage::url(settings()->get('app_logo'))) }}" alt="" width="100">
                        @endif
                    </td>
                    <td class="text-black" style="text-align:center;vertical-align:middle;">
                        <div style="font-size:20px;font-weight:bold;margin-top:0.6rem">PONDOK PESANTREN</div>
                        <div style="font-size:24px;font-weight:bold;margin-top:-0.3rem">TARBIYATUL MUTATHOWI'IN</div>
                        <div style="margin-top:-0.3rem">Jalan Sunan Bonang Ngujur Rejosari Kecamatan Kebonsari</div>
                        <div style="margin-top:-0.3rem">Kabupaten Madiun, 63173, No Hp. 089523969760</div>
                    </td>
                    {{-- <td width="20%"></td> --}}
                </tr>
            </table>
            <hr style="margin-top: -0.5rem">
            <table cellpadding="0" cellspacing="0">
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span class="nama">{{ $santri->nama }}</span><br />
                                    Kelas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $santri->kelas }}<br />
                                    Nama Wali : <span class="nama">{{ $santri->wali->name }}</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <table width="100%" class="table-tagihan">
                            <tr class="heading">
                                <th style="text-align: center">No</th>
                                <th style="text-align: center">Bulan</th>
                                <th style="text-align: center">Jumlah Tagihan</th>
                                <th style="text-align: center">Tanggal Bayar</th>
                                <th style="text-align: center">Paraf</th>
                                <th style="text-align: center">Keterangan</th>
                            </tr>
                            @foreach ($kartuSpp as $item)
                            <tr class="item">
                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                <td style="text-align: left">{{ $item['bulan'].' '.$item['tahun'] }}</td>
                                <td style="text-align: end">{{ formatRupiah($item['total_tagihan']) }}</td>
                                <td style="text-align: center">{{ $item['tanggal_bayar'] }}</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
            </table>
            <div class="tombol">
                <a href="{{ url()->full() . '&output=pdf' }}" class="download-pdf">Download PDF</a>
                <a href="#" onclick="window.print()" class="cetak">Cetak</a>
            </div>
        </div>
    </div>
</body>
</html>
