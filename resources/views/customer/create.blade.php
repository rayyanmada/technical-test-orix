@extends('shared_pages.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>{{ $dt['title'] }}</h5>
        </div>
        <div class="card-body">
            <form class="forms-sample" action="{{ route('customer.store') }}" method="POST">
                @csrf
                @method('post')
                <div class="row form-group">
                    <div class="col-md-3">
                        <label>Nama Sales</label>
                    </div>
                    <div class="col-sm-9">
                        <select type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id"
                            value="{{ old('user_id') }}">
                            <option value="">-- Pilih sales --</option>
                            @foreach ($dt['sales'] as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label>Nama Customer</label>
                    </div>
                    <div class="col-md-9 mb-3">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                            value="{{ old('nama') }}" placeholder="Nama customer" autofocus>
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label>Alamat Customer</label>
                    </div>
                    <div class="col-md-9 mb-3">
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                            value="{{ old('alamat') }}" id="formFile">
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label>Telp</label>
                    </div>
                    <div class="col-md-9 mb-3">
                        <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp"
                            value="{{ old('telp') }}">
                        @error('telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label>Nama Onwer / PIC</label>
                    </div>
                    <div class="col-md-9 mb-3">
                        <input type="text" class="form-control @error('pic') is-invalid @enderror" name="pic"
                            value="{{ old('pic') }}">
                        @error('pic')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col">
                        <a href="{{ route('customer.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                    <div class="col text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
