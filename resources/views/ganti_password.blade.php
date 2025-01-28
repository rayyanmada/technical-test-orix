@extends('shared_pages.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h5>Form Ganti Password</h5>
            </div>
        </div>
    </div>
    <div class="card card-warning card-outline">
        <div class="card-header">
        </div>
        <form action="{{ route('update_psswrd', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Nama</strong>
                            <input type="text" name="kode" value="{{ $user->name }}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Username</strong>
                            <input type="text" name="email" class="form-control" value="{{ $user->email }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Password</strong>
                            <input type="password" name="pss1" class="form-control @error('pss1') is-invalid @enderror"
                                placeholder="Pasword" autofocus>
                            @error('pss1')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Konfirmasi Password</strong>
                            <input type="password" name="pss2" class="form-control @error('pss2') is-invalid @enderror"
                                placeholder="Pasword">
                            @error('pss2')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-right">
                        <a href="{{ route('home') }}" type="button" class="btn bg-secondary text-light">Kembali</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
