@extends('shared_pages.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h5>{{ $dt['title'] }}</h5>
            </div>
        </div>
    </div>
    <div class="card card-warning card-outline">
        <div class="card-header">
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <strong>Name</strong>
                        <input type="text" class="form-control" value="{{ $role->name }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <strong>Permissions</strong>
                    <br />
                    @if (!empty($rolePermissions))
                        <div class="row">
                            @foreach ($rolePermissions as $v)
                                <div class="col-md-3">
                                    <label class="d-block">*) {{ $v->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <a href="{{ route('roles.index') }}" type="button" class="btn bg-secondary text-light">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
