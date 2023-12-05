@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tambah Training Karyawan</div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('post_training_karyawan') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">NIP</label>
                                <div class="col-md-6">
                                    <select name="id_karyawan" class="form-control">
                                        <option></option>
                                        @foreach ($karyawan as $item)
                                            <option value="{{ $item->id_karyawan }}">{{ $item->nip }} -
                                                {{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Jenis</label>

                                <div class="col-md-6">
                                    <select name="id_jenis" class="form-control">
                                        <option></option>
                                        @foreach ($jenis as $item)
                                            <option value="{{ $item->id_jenis }}">{{ $item->jenis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Tanggal Sertifikat</label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control" id="tgl_sertifikat" name="tgl_sertifikat"
                                        value="{{ old('tgl_sertifikat') }}">
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
