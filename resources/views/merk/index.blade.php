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
                
                <a href="merk/create" type="button" class="btn btn-success me-2">Tambah Merek</a>

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Merek</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">Merek</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td><button type="button" class="btn btn-success me-2">Edit</button><button type="button" class="btn btn-danger">Delete</button></td>
                      </tr>
                      <tr>
                        <th scope="row">Status</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr>
                        <th scope="row">Aksi</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    </tbody>
                  </table>
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
