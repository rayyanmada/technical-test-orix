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
                <a href="{{ route('customer.create') }}" class="btn btn-outline-success mb-5">
                    <i class="bi bi-plus-circle"></i> Tambah Custmer Baru
                </a>
                <div class="table-responsve">
                    <table class="table" id="table1">
                        <thead>
                            <tr class="bg-orange text-light">
                                <th>No</th>
                                <th>Sales</th>
                                <th>Nama Customer</th>
                                <th>Alamat</th>
                                <th>Telp</th>
                                <th>Owner</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dt['customer'] as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->user->name }}</td>
                                    <td>{{ $p->nama }}</td>
                                    <td>{{ $p->alamat }}</td>
                                    <td>{{ $p->telp }}</td>
                                    <td>{{ $p->pic }}</td>
                                    <td>
                                        <form onsubmit="return confirm('Benar akan meghapus data ini ?')"
                                            action="{{ route('customer.destroy', $p->id) }}" method="POST">
                                            @can('customer-edit')
                                                <a class="btn btn-sm btn-primary" href="{{ route('customer.edit', $p->id) }}"
                                                    title="Edit Customer"><i class="bi bi-pencil"></i></a>
                                            @endcan
                                            @csrf
                                            @method('DELETE')
                                            @can('customer-delete')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete Customer"><i
                                                        class="bi bi-x"></i></button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-danger text-center">Data customer belum ada</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endSection
