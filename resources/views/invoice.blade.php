<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Invoice Tagihan | {{ config('app.name', 'Laravel') }}</title>


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

        .tombol {
            margin-top: 1rem;
            display: flex;
            justify-content: center;
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
            margin-right: 0.5rem;
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
                                <td width="25%">
                                    Nama : <span class="nama">{{ $tagihan->santri->nama }}</span><br />
                                    Kelas : {{ $tagihan->santri->kelas }}<br />
                                    Jenis SPP : {{ $tagihan->santri->jenis_spp }}
                                </td>
                                <td width="35%">
                                    ID Tagihan : #PPTMSPP{{ $tagihan->tanggal_tagihan->translatedFormat('m') }}{{ $tagihan->id }}<br />
                                    Tanggal Tagihan : {{ $tagihan->tanggal_tagihan->translatedFormat('d F Y') }}<br />
                                    Tanggal Jatuh Tempo : {{ $tagihan->tanggal_jatuh_tempo->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="heading">
                    <td>Item Tagihan</td>
                    <td>Sub-Total Biaya</td>
                </tr>
                @foreach ($tagihan->tagihanDetails as $item)
                <tr class="item">
                    <td>{{ $item->nama_biaya }}</td>
                    <td>{{ formatRupiah($item->jumlah_biaya) }}</td>
                </tr>
                @endforeach

                <tr class="total">
                    <td>Total Tagihan</td>

                    <td>{{ formatRupiah($tagihan->total_tagihan) }}</td>
                </tr>
            </table>
            <div class="tombol">
                <a href="{{ url()->current() . '?output=pdf' }}" class="download-pdf">Download PDF</a>
                <a href="#" onclick="window.print()" class="cetak">Cetak</a>
            </div>
        </div>
    </div>
</body>
</html>
