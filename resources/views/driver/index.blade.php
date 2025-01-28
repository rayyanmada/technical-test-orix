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
                                @can('driver-create')
                                    <a class="btn btn-outline-success" href="{{ route('driver.create') }}"> Tambah driver
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
                                <th>Alamat</th>
                                <th>Telp</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dt['driver'] as $p)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</>
                                    <td class="align-middle text-center">
                                        <img src="{{ asset('storage/driver/' . $p->photo) }}" class="btn-show-photo"
                                            alt="photodriver" width="90px" data-id="{{ $p->id }}">
                                        <div class="mt-2">
                                            <button class="btn btn-sm btn-outline-primary btn-show-photo"
                                                data-id="{{ $p->id }}">
                                                Show
                                            </button>
                                        </div>
                                    </td>
                                    <td class="align-middle">{{ $p->nama }}</td>
                                    <td class="align-middle">{{ $p->alamat }}</td>
                                    <td class="align-middle">{{ $p->telp }}</td>
                                    <td class="align-middle">
                                        <?php
                                        if ($p->aktive == 0) {
                                            $color = 'bg-warning';
                                            $aktive = 'No';
                                        } else {
                                            $color = 'bg-success';
                                            $aktive = 'Aktive';
                                        }
                                        ?>
                                        <div class="badges">
                                            <span class="badge {{ $color }}">
                                                {{ $aktive }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <form onsubmit="return confirm('Benar akan meghapus data ini ?')"
                                            action="{{ route('driver.destroy', $p->id) }}" method="POST">
                                            @can('driver-edit')
                                                <a class="btn btn-sm btn-primary" href="{{ route('driver.edit', $p->id) }}"
                                                    title="Edit"><i class="bi bi-pencil"></i></a>
                                            @endcan
                                            @csrf
                                            @method('DELETE')
                                            @can('driver-delete')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i
                                                        class="bi bi-x"></i></button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-danger">Belum ada data driver</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @include('driver.show_photo')

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
                        <img src="storage/driver/${responds.photo}" alt="photodriver" width="400px">      
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
