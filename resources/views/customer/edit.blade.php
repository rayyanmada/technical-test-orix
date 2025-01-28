@extends('shared_pages.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>{{ $dt['title'] }}</h5>
        </div>
        <div class="card-body">
            <form class="forms-sample" action="{{ route('customer.update', $dt['customer']->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row form-group">
                    <div class="col-md-2">
                        <label>Nama Sales</label>
                    </div>
                    <div class="col-md-9 mb-3">
                        <select type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id"
                            value="{{ old('user_id') }}">
                            @foreach ($dt['sales'] as $p)
                                <option value="{{ $p->id }}"
                                    {{ $dt['customer']->user_id == $p->id ? 'selected' : '' }}>
                                    {{ $p->name }}</option>
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
                    <div class="col-md-2">
                        <label>Nama Customer</label>
                    </div>
                    <div class="col-md-9 mb-3">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                            value="{{ $dt['customer']->nama }}" placeholder="Nama customer" autofocus>
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label>Alamat Customer</label>
                    </div>
                    <div class="col-md-9 mb-3">
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                            value="{{ $dt['customer']->alamat }}" id="formFile">
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label>Telp</label>
                    </div>
                    <div class="col-md-9 mb-3">
                        <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp"
                            value="{{ $dt['customer']->telp }}">
                        @error('telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label>Nama Onwer / PIC</label>
                    </div>
                    <div class="col-md-9 mb-3">
                        <input type="text" class="form-control @error('pic') is-invalid @enderror" name="pic"
                            value="{{ $dt['customer']->pic }}">
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
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
