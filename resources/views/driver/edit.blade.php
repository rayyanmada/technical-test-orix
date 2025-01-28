@extends('shared_pages.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>{{ $dt['title'] }}</h5>
        </div>
        <div class="card-body">
            <form class="forms-sample" action="{{ route('driver.update', $dt['driver']->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nama driver</label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                value="{{ $dt['driver']->nama }}" autofocus>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Alamat</label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" name="alamat" value="{{ $dt['driver']->alamat }}"
                                class="form-control @error('alamat') is-invalid @enderror">
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Telp</label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" name="telp" value="{{ $dt['driver']->telp }}"
                                class="form-control @error('telp') is-invalid @enderror" placeholder="Telp driver">
                            @error('telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Status Driver</label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <select type="text" name="aktive"
                                class="form-control @error('aktive') is-invalid @enderror">
                                <option value="1" {{ $dt['driver']->aktive == 1 ? 'selected' : '' }}>Aktive</option>
                                <option value="0" {{ $dt['driver']->aktive == 0 ? 'selected' : '' }}>Tidak Aktive
                                </option>
                            </select>
                            @error('aktive')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Photo driver</label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
                        </div>
                        <small class="text-danger">*) kosongkan jika tidak meruba photo</small>
                    </div>
                </div>
                <div class="row justify-content-between mt-4">
                    <div class="col">
                        <a href="{{ route('driver.index') }}" type="button" class="btn btn-secondary">Kembali</a>
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
