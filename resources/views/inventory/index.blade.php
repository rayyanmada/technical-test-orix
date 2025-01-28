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
                <div class="row mb-5">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <div class="pull-right">
                                @can('inventory-create')
                                    <a class="btn btn-outline-success" href="{{ route('inventory.create') }}"> Tambah Inventory
                                        Baru</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-respnsive">
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr class="bg-orange text-light">
                                <th>No</th>
                                <th>Photo</th>
                                <th>Nama</th>
                                <th>Merek</th>
                                <th>Kapasitas Mesin</th>
                                <th>Bahan Bakar</th>
                                <th class="text-end">Harga Sewa</th>
                                <th class="text-end">Qtt (Unit)</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dt['inventory'] as $i)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</>
                                    <td class="align-middle text-center">
                                        <img src="{{ asset('storage/inventory/' . $i->photo) }}" class="btn-show-photo"
                                            alt="photoInventory" width="90px" data-id="{{ $i->id }}">
                                        <div class="mt-2">
                                            <button class="btn btn-sm btn-outline-primary btn-show-photo"
                                                data-id="{{ $i->id }}">
                                                Show
                                            </button>
                                        </div>
                                    </td>
                                    <td class="align-middle">{{ $i->nama }}</td>
                                    <td class="align-middle">{{ $i->merek }}</td>
                                    <td class="align-middle">{{ $i->pwr_mesin }}</td>
                                    <td class="align-middle">{{ $i->oil }}</td>
                                    <td class="align-middle text-end">{{ number_format($i->harga_sewa, 0, ',', '.') }}</td>
                                    <td class="align-middle text-end">{{ $i->qtt }}</td>
                                    <td class="align-middle">{{ $i->keterangan }}</td>
                                    <td class="align-middle">
                                        <form onsubmit="return confirm('Benar akan meghapus data ini ?')"
                                            action="{{ route('inventory.destroy', $i->id) }}" method="POST">
                                            @can('inventory-edit')
                                                <a class="btn btn-sm btn-primary" href="{{ route('inventory.edit', $i->id) }}"
                                                    title="Edit"><i class="bi bi-pencil"></i></a>
                                            @endcan
                                            @csrf
                                            @method('DELETE')
                                            @can('inventory-delete')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i
                                                        class="bi bi-x"></i></button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-danger">Belum ada data inventory</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @include('inventory.show_photo')

    <script>
        $(document).on('click', '.btn-show-photo', function() {
            let id = $(this).data('id')
            $.ajax({
                url: "/getphoto",
                data: {
                    id: id
                },
                dataType: "json",
                beforeSend: function() {
                    $('.modal-body').empty()
                    $('.modal-footer').empty()
                },
                success: function(responds) {
                    $('.modal-body').append(`
                        <img src="storage/inventory/${responds.photo}" alt="photoInventory" width="400px">      
                    `)
                    $('.modal-footer').append(`
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    `)
                    $('.modal').modal('show');
                }
            });
        });
    </script>
@endsection
