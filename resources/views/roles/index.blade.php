@extends('shared_pages.layout')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                {{ $dt['title'] }}
            </div>
            <div class="card-body">
                {{-- konten --}}
                @if ($message = Session::get('success'))
                    <div class="mb-3 pl-3 pr-3">
                        <div class="alert alert-success alert-dismissible show fade">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <div class="row mb-4">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            @can('role-create')
                                <a class="btn btn-outline-success" href="{{ route('roles.create') }}"><i
                                        class="bi bi-plus-circle"></i>
                                    Tambah Hak Akses Baru</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <table class="table" id="table1">
                    <thead>
                        <tr class="bg-orange text-light">
                            <th>No</th>
                            <th>Name</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="{{ route('roles.show', $role->id) }}"
                                        title="Show"><i class="bi bi-eye-fill"></i> </a>
                                    @can('role-edit')
                                        <a class="btn btn-sm btn-primary" href="{{ route('roles.edit', $role->id) }}"
                                            title="Edit"><i class="bi bi-pencil"></i></a>
                                    @endcan
                                    <form onsubmit="return confirm('Benar akan meghapus data ini ?');" class="d-inline"
                                        action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
