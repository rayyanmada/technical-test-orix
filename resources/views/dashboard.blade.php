@extends('shared_pages.layout')
@section('content')
    <section class="row mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Grafik Order Rental</h3>
                </div>
                <div class="card-body">
                    <div id="chart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="table-responsve">
                <table class="table table-striped">
                    <thead>
                        <tr class="bg-orange text-light">
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dt['order'] as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p['bulan'] }}</td>
                                <td>{{ number_format($p['nominal'], 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-danger text-center">Data order rental belum ada</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script>
        var options = {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'sales',
                data: @json($dt['nom_order']),
            }],
            xaxis: {
                categories: @json($dt['x_axis']),
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return "Rp " + value.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
                    }
                },
            },
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>
@endsection
