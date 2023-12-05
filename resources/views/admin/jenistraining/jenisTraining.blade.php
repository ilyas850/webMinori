@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Jenis Training</h1>

        <a href="{{ url('input_jenis_training') }}" class="btn btn-success btn-sm">Input Jenis Training</a>
        <br><br>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis</th>
                    <th>Keterangan</th>
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
                ajax: "{{ route('jenisTraining') }}",
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
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            // Tambahkan link untuk tombol "Edit"
                            var editUrl = "{{ url('edit_jenis_training') }}" + '/' + full
                                .id_jenis;
                            var editBtn = '<a href="' + editUrl +
                                '" class="edit btn btn-success btn-sm">Edit</a>';

                            // Tambahkan link untuk tombol "Delete"
                            var deleteUrl = "{{ url('delete_jenis_training') }}" + '/' + full
                                .id_jenis;
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
