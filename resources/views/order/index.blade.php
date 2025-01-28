@extends('shared_pages.layout')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header text-end">
                <h4>{{ $dt['title'] }}</h4>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="mb-3 pl-3 pr-3">
                        <div class="alert alert-success alert-dismissible show fade">
                            <i class="far fa-fw fa-bell"></i> {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                @can('peminjaman-create')
                    <a href="{{ route('order.create') }}" class="btn btn-outline-success mb-5">
                        <i class="bi bi-plus-circle"></i> Buat Order Baru
                    </a>
                @endcan
                <div class="table-responsve">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr class="bg-orange text-light">
                                <th>No</th>
                                <th>Status</th>
                                <th>Tanggal Order</th>
                                <th>Sales</th>
                                <th>Driver</th>
                                <th>No Order</th>
                                <th>Nama Customer</th>
                                <th>Telp Customer</th>
                                <th>Nominal</th>
                                <th>Approval</th>
                                <th>Tgl Kembali</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $k = 0; ?>
                            @forelse ($dt['order'] as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <?php
                                        if ($p->status == 'Open') {
                                            $color = 'bg-warning';
                                        } else {
                                            $color = 'bg-success';
                                        }
                                        ?>
                                        <div class="badges">
                                            <span class="badge {{ $color }}">
                                                {{ $p->status }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>{{ date('d-M-y', strtotime($p->tgl)) }}</td>
                                    <td>{{ $p->customer->user->name }}</td>
                                    <td>
                                        {{ !empty($p->driver->nama) ? $p->driver->nama : '' }}
                                    </td>
                                    <td>{{ $p->no_order }}</td>
                                    <td>{{ $p->customer->nama }}</td>
                                    <td>{{ $p->customer->telp }}</td>
                                    <td>{{ number_format($p->nominal, 0, ',', '.') }}</td>
                                    <td>
                                        <?php
                                        if ($p->approval == null) {
                                            $color = 'bg-warning';
                                            $approval = 'Belum';
                                        } else {
                                            $color = 'bg-success';
                                            $approval = 'Approve';
                                        }
                                        ?>
                                        <div class="badges">
                                            <span class="badge {{ $color }}">
                                                {{ $approval }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="badges">
                                            <span class="badge bg-info">
                                                {{ date('d-M-y', strtotime($dt['tgl_kembali'][$k])) }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($p->status == 'Open')
                                            <button class="btn btn-sm btn-primary" title="Pengembalian"
                                                onclick="kembaliInventory('{{ $p->id }}')"><i
                                                    class="bi bi-check-circle"></i></button>
                                            @if ($p->approval == null)
                                                <button class="btn btn-sm btn-success" title="Approval"
                                                    onclick="approval('{{ $p->id }}')"><i
                                                        class="bi bi-check-circle"></i></button>
                                            @endif
                                        @endif
                                        <form onsubmit="return confirm('Benar akan meghapus data ini ?')"
                                            action="{{ route('order.destroy', $p->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            {{-- @can('peminjaman-delete')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i
                                                        class="bi bi-x"></i></button>
                                            @endcan --}}
                                        </form>
                                    </td>
                                </tr>
                                <?php $k++; ?>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-danger text-center">Data order rental belum ada</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script>
        function kembaliInventory(order_id) {
            Swal.fire({
                title: "Inventory sudah diterima/dikembalikan ?",
                icon: "question",
                closeOnClickOutside: false,
                showCancelButton: true,
                confirmButtonText: 'Iya',
                confirmButtonColor: '#4e73df',
                cancelButtonText: 'Batal',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.value) {
                    window.location.href = `/pengembalian/${order_id}`
                }
            });
        }

        function approval(order_id) {
            Swal.fire({
                title: "Benar akan mengapprove order ini ?",
                icon: "question",
                closeOnClickOutside: false,
                showCancelButton: true,
                confirmButtonText: 'Iya',
                confirmButtonColor: '#4e73df',
                cancelButtonText: 'Batal',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.value) {
                    window.location.href = `/approval/${order_id}`
                }
            });
        }
    </script>
@endSection
