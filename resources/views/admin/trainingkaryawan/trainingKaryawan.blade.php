@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Training Karyawan</h1>

        <a href="{{ url('input_training_karyawan') }}" class="btn btn-success btn-sm">Input Profil Karyawan</a>
        <br><br>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis</th>
                    <th>Tanggal Sertifikat</th>
                    <th>NIP</th>
                    <th width="105px">Action</th>
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
                ajax: "{{ route('trainingKaryawan') }}",
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
                        data: 'jenis',
                        name: 'jenis'
                    },
                    {
                        data: 'tgl_sertifikat',
                        name: 'tgl_sertifikat'
                    },
                    {
                        data: null,
                        name: 'nip_nama',
                        render: function(data, type, full, meta) {
                            return full.nip + ' - ' + full.nama;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            // Tambahkan link untuk tombol "Edit"
                            var editUrl = "{{ url('edit_training_karyawan') }}" + '/' + full
                                .id_training;
                            var editBtn = '<a href="' + editUrl +
                                '" class="edit btn btn-success btn-sm">Edit</a>';

                            // Tambahkan link untuk tombol "Delete"
                            var deleteUrl = "{{ url('delete_training_karyawan') }}" + '/' + full
                                .id_training;
                            var deleteBtn = '<a href="' + deleteUrl +
                                '" class="delete btn btn-danger btn-sm" onclick="return confirm(\'Anda yakin akan menghapus ini?\')">Delete</a>';

                            // Gabungkan kedua tombol dalam satu kolom
                            return editBtn + ' ' + deleteBtn;
                        }
                    },
                ]
            });
        });
    </script>
@endsection
