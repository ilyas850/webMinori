@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tambah Jenis Training</div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('post_jenis_training') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Jenis</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="jenis" name="jenis"
                                        value="{{ old('jenis') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Keterangan</label>
                                <div class="col-md-6">
                                    <textarea name="keterangan" id="keterangan" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
