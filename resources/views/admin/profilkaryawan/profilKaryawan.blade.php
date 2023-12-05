@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Profil Karyawan</h1>

        <a href="{{ url('input_profil_karyawan') }}" class="btn btn-success btn-sm">Input Profil Karyawan</a>
        <br><br>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Karyawan</th>
                    <th>Jabatan</th>
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
                ajax: "{{ route('profilKaryawan') }}",
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
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            // Tambahkan link untuk tombol "Edit"
                            var editUrl = "{{ url('edit_profil_karyawan') }}" + '/' + full
                                .id_karyawan;
                            var editBtn = '<a href="' + editUrl +
                                '" class="edit btn btn-success btn-sm">Edit</a>';

                            // Tambahkan link untuk tombol "Delete"
                            var deleteUrl = "{{ url('delete_profil_karyawan') }}" + '/' + full
                                .id_karyawan;
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
