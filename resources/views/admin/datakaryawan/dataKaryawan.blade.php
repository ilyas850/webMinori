@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Training Karyawan</h1>

        <form action="{{ url('cari_data_karyawan') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <label for="">NIP / Nama</label>
                    <select name="id_karyawan" class="form-control">
                        <option></option>
                        @foreach ($karyawan as $item)
                            <option value="{{ $item->id_karyawan }}">{{ $item->nip }} - {{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Jenis Training</label>
                    <select name="id_jenis" class="form-control">
                        <option></option>
                        @foreach ($jenis as $item)
                            <option value="{{ $item->id_jenis }}">{{ $item->jenis }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Tanggal Sertifikat</label>
                    <select name="tgl_sertifikat" class="form-control">
                        <option></option>
                        @foreach ($tgl as $item)
                            <option value="{{ $item->tgl_sertifikat }}">{{ $item->tgl_sertifikat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for=""></label><br>
                    <button class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>
        <br>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Tanggal Sertifikat</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dataKaryawan') }}",
                columns: [{
                        data: null,
                        name: 'no',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nip',
                        name: 'nip'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'jenis',
                        name: 'jenis'
                    },
                    {
                        data: 'tgl_sertifikat',
                        name: 'tgl_sertifikat'
                    },
                ]
            });
        });
    </script>
@endsection
