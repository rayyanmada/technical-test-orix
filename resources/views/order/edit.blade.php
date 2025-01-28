@extends('shared_pages.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>{{ $dt['title'] }}</h5>
        </div>
        <div class="card-body">
            <form class="forms-sample" action="{{ route('order.update', $dt['order']->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row form-group">
                    <div class="col-sm-12">
                        <label>No Order</label>
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <input class="form-check-input" type="checkbox" value=""
                                    aria-label="Checkbox for following text input">
                            </div>
                            <input type="text" class="form-control" name="no_order" value="{{ $dt['order']->no_order }}"
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-12">
                        <label>Nama Customer</label>
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <input class="form-check-input" type="checkbox" value=""
                                    aria-label="Checkbox for following text input">
                            </div>
                            <select type="text" class="form-control @error('customer_id') is-invalid @enderror"
                                name="customer_id">
                                @foreach ($dt['customer'] as $p)
                                    <option value="{{ $p->id }}"
                                        {{ $p->id == $dt['order']->customer_id ? 'selected' : '' }}>{{ $p->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-12">
                        <label>Catatan Order</label>
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <input class="form-check-input" type="checkbox" value=""
                                    aria-label="Checkbox for following text input">
                            </div>
                            <input type="text" class="form-control @error('catatan') is-invalid @enderror" name="catatan"
                                value="{{ $dt['order']->catatan }}" id="formFile">
                            @error('catatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row form-group mb-4">
                    <div class="col-sm-12">
                        <label>Lampiran</label>
                        <input type="file" class="form-control" name="lampiran" id="formFile">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Update</button>
                <a href="{{ route('order.index') }}" class="btn btn-danger">Kembali</a>
            </form>
        </div>
    </div>
@endsection
