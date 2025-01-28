@extends('shared_pages.layout')
@section('content')
    <section class="section">
        <div class="row mt-3">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="rounded-circle img-fluid" width="150px" src="/assets/images/faces/5.jpg"
                                alt="User profile picture">
                        </div>
                        <h3 class="text-center mt-3">{{ Auth::user()->name }}</h3>
                        {{-- <p class="text-muted text-center">Software Engineer</p> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header p-2">
                        <h5 class="text-center">Data Profile</h5>
                    </div>
                    <div class="card-bdy p-2">
                        <form class="form-horizontal mt-3">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" value="{{ Auth::user()->name }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Level</label>
                                <div class="col-sm-9">
                                    <input class="form-control" value="{{ Auth::user()->roles->pluck('name')[0] }}"
                                        readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
