@extends('shared_pages.layout')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header text-end">
                <h4>{{ $dt['title'] }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsve">
                    <table class="table" id="table1">
                        <thead>
                            <tr class="bg-orange text-light">
                                <th>#</th>
                                <th>Sales</th>
                                <th>Tanggal Invoice</th>
                                <th>No Invoice</th>
                                <th>Nama Customer</th>
                                <th>Nominal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dt['invoice'] as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->customer->user->name }}</td>
                                    <td>{{ date('d-M-Y', strtotime($p->tgl)) }}</td>
                                    <td>{{ $p->no_inv }}</td>
                                    <td>{{ $p->customer->nama }}</td>
                                    <td>{{ number_format($p->nominal, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="/cetakinv/{{ $p->no_inv }}" target="_blank"
                                            class="btn btn-sm btn-outline-success">Cetak
                                            Inv</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-danger text-center">Belum ada data invoice</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endSection
