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
                <div class="table-responsve">
                    <table class="table" id="table1">
                        <thead>
                            <tr class="bg-orange text-light">
                                <th>No</th>
                                <th>Status</th>
                                <th>Sales</th>
                                <th>No Order</th>
                                <th>Nama Customer</th>
                                <th>Telp Customer</th>
                                <th>Tgl Kembali</th>
                                <th>Terlambat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $k = 0; ?>
                            @forelse ($dt['pengembalian'] as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <?php
                                        if ($p->status == 'Terlambat') {
                                            $color = 'bg-warning';
                                        } elseif ($p->status == 'Tepat Waktu') {
                                            $color = 'bg-primary';
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
                                    <td>{{ $p->customer->user->name }}</td>
                                    <td>{{ $p->no_order }}</td>
                                    <td>{{ $p->customer->nama }}</td>
                                    <td>{{ $p->customer->telp }}</td>
                                    <td>
                                        <div class="badges">
                                            <span class="badge bg-primary">
                                                {{ date('d-M-y', strtotime($p->tgl_kembali)) }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>{{ $p->terlambat }} hari</td>
                                    <td>
                                        @if ($p->status != 'Invoice')
                                            <button class="btn btn-sm btn-success" title="Invoicing"
                                                onclick="invoicing('{{ $p->id }}')"><i
                                                    class="bi bi-currency-dollar"></i></button>
                                            <form onsubmit="return confirm('Benar akan meghapus data ini ?')"
                                                action="{{ route('finishorder.destroy', $p->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                @can('peminjaman-delete')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i
                                                            class="bi bi-x"></i></button>
                                                @endcan
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                <?php $k++; ?>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-danger text-center">Data pengembalian inventory order
                                        rental belum ada</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script>
        function invoicing(id) {
            Swal.fire({
                title: "Benar akan membuat invoice data ini ?",
                icon: "question",
                closeOnClickOutside: false,
                showCancelButton: true,
                confirmButtonText: 'Iya',
                confirmButtonColor: '#4e73df',
                cancelButtonText: 'Batal',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.value) {
                    window.location.href = `/invoicing/${id}`
                }
            });
        }
    </script>
@endSection
