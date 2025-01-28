<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print PDF</title>

    <link rel="stylesheet" href="/assets/css/main/app.css">
    <link rel="stylesheet" href="/assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="/assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="/assets/images/logo/favicon.png" type="image/png">

    <style>
        @media print {
            button.btn.btn-sm.btn-danger {
                display: none;
            }
        }

        td {
            font-size: 0.6em;
            height: 20px;
        }

        th {
            font-size: 0.7em;
            height: 50px;
        }

        p {
            font-size: 0.6em;
        }

        small {
            font-size: 0.8em;
            display: block;
        }

        th,
        td {
            font-size: 0.8em;
        }

        .bg-orange {
            background-color: orangered;
        }

        .text-putih {
            text-color: white;
        }
    </style>
</head>

<body class="fw-bold">
    <div class="container-fluid mt-2">
        <div class="card">
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-2">
                        <img src="{{ asset('assets/images/logo/logo_galaxytech.jpg') }}" width="90px">
                    </div>
                    <div class="col-9">
                        <h4>INVOICE</h4>
                        <small>
                            Jl Diponegoro No 19 <br />
                            Surabaya, Jawa Timur <br />
                            Indonesia <br />
                        </small>
                    </div>
                </div>
                <hr class="text-success">
                <div class="row">
                    <div class="col-7">
                        <h6>CUSTOMER</h6>
                        <small>{{ $dataInvoice->customer->nama }}</small>
                        <small>{{ $dataInvoice->customer->alamat }}</small>
                        <small>{{ $dataInvoice->customer->telp }}</small>
                    </div>
                    <div class="col-5">
                        <div class="row">
                            <div class="col-5 text-end">
                                <small>Nomor</small>
                            </div>
                            <div class="col-7">
                                <small>: {{ $dataInvoice->no_inv }}</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 text-end">
                                <small>Tanggal</small>
                            </div>
                            <div class="col-7">
                                <small>: {{ date('d-M-Y', strtotime($dataInvoice->tgl)) }}</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 text-end">
                                <small>Nominal</small>
                            </div>
                            <div class="col-7">
                                <small>: {{ number_format($dataInvoice->nominal, 0, ',', '.') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <table class="table mt-2" width="100%">
                    {{-- <table class="table table-sm mt-2" width="100%"> --}}
                    <thead>
                        <tr>
                            <th class="ps-2">No </th>
                            <th>Inventory </th>
                            <th>Qtt</th>
                            <th width="25px">Harga Sewa</th>
                            <th>Durasi</th>
                            <th class="text-end pe-2">Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        <?php $denda = 0; ?>
                        {{-- perincian detil inv --}}
                        @foreach ($detilOrder as $p)
                            <tr>
                                <td class="ps-2">{{ $loop->iteration }}</td>
                                <td>{{ $p->inventory->nama }}</td>
                                <td>{{ $p->qtt }}</td>
                                <td>{{ number_format($p->inventory->harga_sewa, 0, ',', '.') }}</td>
                                <td>{{ $p->durasi }} hari</td>
                                <td class="text-end pe-2">{{ number_format($p->nominal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" class="text-center">Tambahan durasi / keterlambatan</td>
                        </tr>
                        <?php $k = 0; ?>
                        @if ($dataPengembalian->terlambat > 0)
                            @foreach ($detilOrder as $p)
                                <?php $subtotal = $p->qtt * $p->inventory->harga_sewa * $dataPengembalian->terlambat; ?>
                                <tr>
                                    <td class="ps-2">{{ $loop->iteration }}</td>
                                    <td class="ps-2">{{ $p->inventory->nama }}</td>
                                    <td>{{ $p->qtt }}</td>
                                    <td>{{ number_format($p->inventory->harga_sewa, 0, ',', '.') }}</td>
                                    <td>{{ $dataPengembalian->terlambat }} hari</td>
                                    <td class="text-end pe-2">{{ number_format($subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        @endif
                        <tr>
                            <td colspan="5" class="text-end">T O T A L</td>
                            <td class="text-end pe-2">{{ number_format($dataInvoice->nominal, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="row mt-3 ps-2">
                    <div class="col">
                        <button class="btn btn-sm btn-danger justify-content-end" onclick="window.print()">
                            <i class=" bi bi-printer me-2"></i>Print
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
