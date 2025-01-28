@extends('shared_pages.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h3>Form Tambah User Baru</h3>
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
            {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                        <strong>Nama</strong>
                        {!! Form::text('name', null, [
                            'placeholder' => 'Name',
                            'class' => 'form-control',
                            'autofocus',
                        ]) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                        <strong>Email</strong>
                        {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                        <strong>Password</strong>
                        {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                        <strong>Confirm Password</strong>
                        {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Role (Pilih Role)</strong>
                        {!! Form::select('roles[]', $roles, [], ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                    <a href="{{ route('users.index') }}" type="button" class="btn bg-secondary text-light">Kembali</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
