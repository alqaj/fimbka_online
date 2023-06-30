@extends('website.layouts.main')

@section('content')
    <h3>Kontrol Barang Keluar</h3>
    <br>
    <div class="row">
        <div class="col-md-6">
            <select class="form-control" id="filter_data">
                <option value="" disabled selected>-- Filter Data --</option>
                <option value="Semua">Semua</option>
                <option value="Sedang Dipinjam">Sedang Dipinjam</option>
                <option value="Overdue">Overdue</option>
            </select>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No Registrasi</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tgl Dibuat</th>
                    <th>Tgl Harus Kembali</th>
                    <th>Status</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
@endsection
@push('styles')
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
@endpush
@push('scripts')
    <script src="{{ asset('vendor/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script lang="text/javascript">
        $(function() {
            var table = $('.table').DataTable({
                'bLengthChange': false,
                'language': {
                    'search': 'Cari',
                    'lengthMenu': 'Tampilkan _MENU_ data per halaman',
                    'info': 'Menampilkan halaman _PAGE_ dari _PAGES_'
                },
                processing: true,
                ordering: false,
                'searching': false,
                serverSide: true,
                ajax: {
                    'url': "{{ route('website.izin.ajax_show_control') }}",
                    data: {
                        'filter': function() {
                            return $('#filter_data').val();
                        }
                    }
                },
                columns: [{
                        data: 'reg_no',
                        name: 'reg_no',
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang',
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row, meta) {
                            return data.substring(0, 10)
                        }
                    },
                    {
                        data: 'tgl_kembali',
                        name: 'tgl_kembali',
                        render: function(data, type, row, meta) {
                            return data.substring(0, 10)
                        }
                    },
                    {
                        data: null,
                        searchable: false,
                        render: function(data, type, row, meta) {

                            if (data.keterangan_kembali == 0) {

                                var tgl_kembali = new Date(data.tgl_kembali.substring(0, 10))
                                var hari_ini = new Date();

                                if (tgl_kembali > hari_ini)
                                    return `<span class="badge rounded-pill bg-warning text-dark">Sedang Dipinjam</span>`
                                else
                                    return `<span class="badge rounded-pill bg-danger">Overdue</span>`

                            } else {
                                return `<span class="badge rounded-pill bg-success">Selesai</span>`
                            }

                        },
                    },
                    {
                        data: null,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return `<button class="btn btn-light border btn-sm btn-detail"><i class="fas fa-search"></i></button>`
                        },
                    }
                ]

            })

            $('#filter_data').on('change', function() {
                table.ajax.reload()
            })
        })
    </script>
@endpush
