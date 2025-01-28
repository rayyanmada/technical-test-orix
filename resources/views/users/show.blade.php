@extends('shared_pages.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Detil User</h2>
            </div>
        </div>
    </div>
    <div class="card card-warning card-outline">
        <div class="card-header">
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <div class="form-group">
                        <strong>Name</strong>
                        <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="form-group">
                        <strong>Email</strong>
                        <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="form-group">
                        <strong>Roles</strong>
                        <br />
                        @if (!empty($user->getRoleNames()))
                            @foreach ($user->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                        <a href="{{ route('users.index') }}" type="button" class="btn bg-primary text-light">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
