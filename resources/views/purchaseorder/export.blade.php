<!DOCTYPE html>
<html>
<head>
    <title>Data Meal Attendance SKP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <style type="text/css">
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size  : 11px;
            margin     : auto;
            max-width  : 792px;
            max-height : 754px;
        }
        h5, h6 {
            font-size: 11px;
        }
        table tr td,
        table tr th {
            font-size: 9pt;
        }
        ol {
            padding-left: 1em;  /* Adjust the padding as needed */
            margin-left : 0;    /* Ensure no additional margin is added */
        }
        .header-info {
            display        : flex;
            justify-content: space-between;
            align-items    : flex-start;     /* Align items to the start */
            margin         : 0;
        }
        .header-info div {
            align-self: flex-start; /* Ensure individual divs align to the start */
        }
        .header-info .nomor_po {
            position: absolute;
            bottom: 57em;
        }
        .header-info .tanggal {
            position: absolute;
            bottom  : 57em;
            left    : 26em;
        }
        .kepada {
            margin-top: 3em;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .container {
            padding-left : 0;
            padding-right: 0;
        }
        .text-perusahaan {
            display        : flex;
            justify-content: space-between;
            align-items    : flex-start;     /* Align items to the start */
            margin         : 0;
        }
        .text-perusahaan .perusahaan {
            position: absolute;
            margin  : auto;
            bottom  : 20em;
            left    : 5em;
        }
        .text-perusahaan .budi {
            text-align: center;
            position  : absolute;
            margin    : auto;
            bottom    : 11em;
            left      : 2em;
        }
        .text-perusahaan .janet {
            text-align: center;
            position  : absolute;
            margin    : auto;
            bottom    : 11em;
            left      : 13em;
        }
        .text-perusahaan .pic-vendor {
            margin-top: 8em;
        }
        .text-perusahaan .vendor {
            position: absolute;
            margin  : auto;
            bottom  : 20em;
            left    : 25em;
        }
    </style>
    <center>
        <h5 class="mt-4 pt-4"><b><u>PURCHASE ORDER (PO)</u></b></h5>
    </center>
    <div class="container">
        <div class="col-12 align-self-start">
            <div class="header-info">
                <div class="nomor_po">
                    <p class="text-left">No : {{ $purchase->nomor_po }}/SKP-PO/{{ convertToRoman($purchase->tanggal->format('n')) }}/{{ now()->year }}</p>
                </div>
                <div class="tanggal">
                    <p class="text-end">Jakarta, {{ $purchase->tanggal->format('d M Y') }}</p>
                </div>
            </div>
            <div class="row pt-3 kepada">
                <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                    <p class="mb-1">Kepada:</p>
                    <h6 class="mb-1"><b>{{ $purchase->vendor->nama_vendor }}</b></h6>
                    <p class="mb-1">{{ $purchase->vendor->alamat }}</p>
                    <p class="mb-1">U.P <b>{{ $purchase->vendor->pic }}<br>({{ $purchase->vendor->jabatan_pic }})</br></p>
                </div>
            </div>
            <div class="table-responsive text-nowrap pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">Harga/ Unit</th>
                            <th class="text-center">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchase->item as $p)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">{{ $p->nama_item }}</td>
                                <td class="text-center">{{ $p->pivot->quantity }}</td>
                                <td class="text-right">Rp {{ $p->harga }},-</td>
                                <td class="text-right">Rp {{ $p->pivot->total_harga }},-</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="align-top px-4 py-4">
                                    <p class="mb-2 mt-3">
                                        <span class="ms-3 fw-semibold"></span>
                                        <span></span>
                                    </p>
                                    <span class="ms-3"></span>
                                </td>
                                <td class="text-right">
                                    <p class="mb-2 text-right">Subtotal:</p>
                                    <p class="mb-2 text-right">PPN 11%:</p>
                                    <p class="mb-0 text-right">Grand Total:</p>
                                </td>
                                <td>
                                    <p class="fw-semibold mb-2 text-right">Rp {{ $purchase->sub_total }},-</p>
                                    <p class="fw-semibold mb-2 text-right">Rp {{ $purchase->ppn }},-</p>
                                    <p class="fw-semibold mb-0 text-right">Rp {{ $purchase->grand_total }},-</p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-12">
                    <span class="fw-semibold"><b><u>Ketentuan PO:</u></b></span>
                    <div id="vendor-info" class="mt-3 text-left">
                        <ol class="text-nowrap">
                            <li>Lokasi Serah Terima Produk: Lumire Hotel 2nd Fl, Jalan Senen Raya No.135, Senen – Jakarta Pusat.</li>
                            <li>Dokumen penagihan ASLI harap dikirimkan ke alamat: <br>
                                <b>PT Santini Kelola Persada</b> <br>
                                <b>Lumire Hotel lantai 2</b><br>
                                <b>Jalan Senen Raya nomor 135 – Jakarta 10410</b><br>
                                <b>u.p Finance Department.</b>
                            </li>
                            <li class="pt-3">Pembayaran tagihan akan ditujukan ke rekening dibawah ini: <br>
                                <b>Nama Rekening   :  {{ $purchase->vendor->nama_vendor }}</b> <br>
                                <b>Nomor Rekening  :  693-021-828</b> <br>
                                <b>Bank            :  BCA</b> <br>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="text-perusahaan">
                <div class="perusahaan">
                    <p class="text-left"><b>{{ $purchase->perusahaan->nama_perusahaan }}</b></p>
                </div>
                <div class="budi">
                    <p class="pt-5"><b>Budi Utomo Al Sunardi</b><br>Corporate IT Manager</p>
                </div>
                <div class="janet">
                    <p class="mr-4 pt-5"><b>Janet Felicia</b><br>Direktur</p>
                </div>
                <div class="vendor">
                    <p class="text-right"><b>{{ $purchase->vendor->nama_vendor }}</b></p>
                </div>
                <div class="pic-vendor">
                    <p class="mr-4 pt-5 text-right"><b>{{ $purchase->vendor->pic }}</b></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
