@extends('shared_pages.layout')
@section('content')
    @if (count($errors) > 0)
        <div class="alert bg-danger text-light">
            <strong>Whoops!</strong> Data entri belum valid.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card card-warning card-outline">
        <div class="card-header">
            <h5>Form {{ $dt['title'] }}</h5>
        </div>
        {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <strong>Nama Hak Akses</strong>
                        {!! Form::text('name', null, ['placeholder' => 'Nama', 'class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <strong>Permissions</strong>
                    <br /><br />
                    <div class="row">
                        @foreach ($permission as $value)
                            <div class="col-md-3">
                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                                    {{ $value->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                    <a href="{{ route('roles.index') }}" type="button" class="btn bg-secondary text-light">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
