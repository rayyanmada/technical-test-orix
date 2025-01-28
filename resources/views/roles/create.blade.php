@extends('shared_pages.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h5>Form {{ $dt['title'] }}</h5>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible show fade">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card card-warning card-outline">
        <div class="card-header">
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Nama Hak Akses</strong>
                        {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control', 'autofocus']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <strong>Permission</strong>
                    </div>
                </div>
                <div class="col-md-10 col-sm-12">
                    <div class="form-group">
                        <div class="row">
                            @foreach ($permission as $value)
                                <div class="col-md-3">
                                    <label>{{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                                        {{ $value->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 text-end">
                    <a href="{{ route('roles.index') }}" type="button" class="btn bg-secondary text-light">Kembali</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
