@extends('shared_pages.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>{{ $dt['title'] }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('inventory.store') }}" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nama Inventory</label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="nama"
                                    class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}"
                                    placeholder="Nama" autofocus>
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
                                <select type="text" name="merek"
                                    class="form-control @error('merek') is-invalid @enderror" placeholder="merek">
                                    <option value="">-- Pilih Merek --</option>
                                    <option value="Toyota" {{ old('merek') == 'Toyota' ? 'selected' : '' }}>Toyota</option>
                                    <option value="Daihatsu" {{ old('merek') == 'Daihatsu' ? 'selected' : '' }}>Daihatsu
                                    </option>
                                    <option value="Mitsubishi" {{ old('merek') == 'Mitsubishi' ? 'selected' : '' }}>
                                        Mitsubishi</option>
                                    <option value="Suzuki" {{ old('merek') == 'Suzuki' ? 'selected' : '' }}>Suzuki</option>
                                    <option value="Nissan" {{ old('merek') == 'Nisan' ? 'selected' : '' }}>Nissan</option>
                                    <option value="Mazda" {{ old('merek') == 'Mazda' ? 'selected' : '' }}>Mazda</option>
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
                                <select type="text" name="pwr_mesin" value="{{ old('pwr_mesin') }}"
                                    class="form-control @error('pwr_mesin') is-invalid @enderror" placeholder="pwr_mesin">
                                    <option value="">-- Pilih Kapasitas Mesin --</option>
                                    <option value="1000 cc" {{ old('pwr_mesin') == '1000 cc' ? 'selected' : '' }}>1000 cc
                                    </option>
                                    <option value="1100 cc" {{ old('pwr_mesin') == '1100 cc' ? 'selected' : '' }}>1100 cc
                                    </option>
                                    <option value="1300 cc" {{ old('pwr_mesin') == '1300 cc' ? 'selected' : '' }}>1300 cc
                                    </option>
                                    <option value="1500 cc" {{ old('pwr_mesin') == '1500 cc' ? 'selected' : '' }}>1500 cc
                                    </option>
                                    <option value="1800 cc" {{ old('pwr_mesin') == '1800 cc' ? 'selected' : '' }}>1800 cc
                                    </option>
                                    <option value="2000 cc" {{ old('pwr_mesin') == '2000 cc' ? 'selected' : '' }}>2000 cc
                                    </option>
                                    <option value="2500 cc" {{ old('pwr_mesin') == '2500 cc' ? 'selected' : '' }}>2500 cc
                                    </option>
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
                                <select type="text" name="oil"
                                    class="form-control @error('oil') is-invalid @enderror" placeholder="oil">
                                    <option value="">-- Pilih Jenis Bahan Bakar --</option>
                                    <option value="Bensin" {{ old('oil') == 'Bensin' ? 'selected' : '' }}>Bensin</option>
                                    <option value="Solar" {{ old('oil') == 'Solar' ? 'selected' : '' }}>Solar</option>
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
                                <input type="text" name="qtt" value="{{ old('qtt') }}"
                                    class="form-control @error('qtt') is-invalid @enderror"
                                    placeholder="Quantity Inventory">
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
                            <div class="for-group mb-3">
                                <input type="number" name="harga_sewa" value="{{ old('harga_sewa') }}"
                                    class="form-control @error('harga_sewa') is-invalid @enderror"
                                    placeholder="Harga sewa per hari">
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
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" style="height:125px" name="keterangan"
                                    placeholder="Keterangan produk"></textarea>
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
                            <div class="form-group mb-3">
                                <input type="file" name="photo"
                                    class="form-control @error('photo') is-invalid @enderror">
                                @error('photo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col">
                            <a href="{{ route('inventory.index') }}" type="button"
                                class="btn btn-secondary">Kembali</a>
                        </div>
                        <div class="col text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
