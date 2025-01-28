@extends('shared_pages.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>{{ $dt['title'] }}</h5>
        </div>
        <div class="card-body">
            <form class="forms-sample" action="{{ route('inventory.update', $dt['inventory']->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nama Inventory</label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                value="{{ $dt['inventory']->nama }}" autofocus>
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
                            <label>Merek</label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <select type="text" name="merek" class="form-control @error('merek') is-invalid @enderror"
                                placeholder="merek">
                                <option value="Toyota" {{ $dt['inventory']->merek == 'Toyota' ? 'selected' : '' }}>Toyota
                                </option>
                                <option value="Daihatsu" {{ $dt['inventory']->merek == 'Daihatsu' ? 'selected' : '' }}>
                                    Daihatsu</option>
                                <option value="Mitsubishi" {{ $dt['inventory']->merek == 'Mitsubishi' ? 'selected' : '' }}>
                                    Mitsubishi</option>
                                <option value="Suzuki" {{ $dt['inventory']->merek == 'Suzuki' ? 'selected' : '' }}>Suzuki
                                </option>
                                <option value="Nissan" {{ $dt['inventory']->merek == 'Nissan' ? 'selected' : '' }}>Nissan
                                </option>
                                <option value="Mazda" {{ $dt['inventory']->merek == 'Mazda' ? 'selected' : '' }}>Mazda
                                </option>
                            </select>
                            @error('merek')
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
                            <label>Kapasitas Mesin</label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <select type="text" name="pwr_mesin"
                                class="form-control @error('pwr_mesin') is-invalid @enderror" placeholder="pwr_mesin">
                                <option value="1000 cc" {{ $dt['inventory']->pwr_mesin == '1000 cc' ? 'selected' : '' }}>
                                    1000 cc</option>
                                <option value="1100" {{ $dt['inventory']->pwr_mesin == '1100 cc' ? 'selected' : '' }}>
                                    1100 cc</option>
                                <option value="1300 cc" {{ $dt['inventory']->pwr_mesin == '1300 cc' ? 'selected' : '' }}>
                                    1300 cc</option>
                                <option value="1500 cc" {{ $dt['inventory']->pwr_mesin == '1500 cc' ? 'selected' : '' }}>
                                    1500 cc</option>
                                <option value="1800 cc" {{ $dt['inventory']->pwr_mesin == '1800 cc' ? 'selected' : '' }}>
                                    1800 cc</option>
                                <option value="2000 cc" {{ $dt['inventory']->pwr_mesin == '2000 cc' ? 'selected' : '' }}>
                                    2000 cc</option>
                                <option value="2500 cc" {{ $dt['inventory']->pwr_mesin == '2500 cc' ? 'selected' : '' }}>
                                    2500 cc</option>
                            </select>
                            @error('pwr_mesin')
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
                            <label>Jenis Bahan Bakar</label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <select type="text" name="oil" class="form-control @error('oil') is-invalid @enderror"
                                placeholder="oil">
                                <option value="Bensin" {{ $dt['inventory']->oil == 'Bensin' ? 'selected' : '' }}>Bensin
                                </option>
                                <option value="Solar" {{ $dt['inventory']->oil == 'Solar' ? 'selected' : '' }}>Solar
                                </option>
                            </select>
                            @error('oil')
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
                            <label>Quantity</label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="text" name="qtt" class="form-control @error('qtt') is-invalid @enderror"
                                value="{{ $dt['inventory']->qtt }}">
                            @error('qtt')
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
                            <label>Harga Sewa / Hari</label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group mb-3">
                            <input type="number" name="harga_sewa"
                                class="form-control @error('harga_sewa') is-invalid @enderror"
                                value="{{ $dt['inventory']->harga_sewa }}">
                            @error('harga_sewa')
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
                            <label>Keterangan</label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                value="{{ $dt['inventory']->keterangan }}">
                            @error('keterangan')
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
                            <label>Photo Inventory</label>
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
                        <a href="{{ route('inventory.index') }}" type="button" class="btn btn-secondary">Kembali</a>
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
