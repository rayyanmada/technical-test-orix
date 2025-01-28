@extends('shared_pages.layout')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                {{ $dt['title'] }}
            </div>
            <div class="card-body">
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
                            <a class="btn btn-success" href="{{ route('users.create') }}"> <i class="bi bi-plus-circle"></i>
                                Tambah User
                                Baru</a>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped" id="table1">
                    <thead>
                        <tr class="bg-orange text-light">
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($data as $user)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $v)
                                            <label>{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <form onsubmit="return confirm('Benar akan meghapus data ini ?')"
                                        action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @can('user-edit')
                                            <a class="btn btn-sm btn-primary" href="{{ route('users.edit', $user->id) }}"
                                                title="Edit"><i class="bi bi-pencil"></i></a>
                                        @endcan
                                        @csrf
                                        @method('DELETE')
                                        @can('user-delete')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i
                                                    class="bi bi-x"></i></button>
                                        @endcan
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
