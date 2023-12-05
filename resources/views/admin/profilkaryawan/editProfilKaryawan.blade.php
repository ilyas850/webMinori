@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Profil Karyawan</div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('update_profil_karyawan/'.$data->id_karyawan) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">NIP</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="nip" name="nip" value="{{ $data->nip }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Nama Karyawan</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $data->nama }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Jabatan</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $data->jabatan }}">
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
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
