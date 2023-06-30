@extends('website.layouts.main')

@section('content')
    <h3>Konfirmasi Barang Kembali</h3>
    <br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Detail</th>
                <th>No Registrasi</th>
                <th>Creator</th>
                <th>Tgl Dibuat</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection
@push('styles')
    {{-- <link href="{{ asset('vendor/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" /> --}}
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        tbody tr td.details-control {
            background: url("{{ asset('img/details_open.png') }}") no-repeat center center;
            cursor: pointer;
        }

        tr.details td.details-control {
            background: url("{{ asset('img/details_close.png') }}") no-repeat center center;
        }
    </style>
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
                serverSide: true,
                ajax: {
                    'url': "{{ route('website.izin.ajax_show_confirmation') }}",
                },
                columns: [{
                        data: null,
                        className: 'details-control',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return ''
                        },
                    },
                    {
                        data: 'reg_no',
                        name: 'reg_no',
                    },
                    {
                        data: 'creator_name',
                        name: 'creator_name',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row, meta) {
                            return data.substring(0, 10)
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },

                ]

            })

            var detailsRow = [];

            $('.table tbody').on('click', 'tr td.details-control', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var idx = $.inArray(tr.attr('id'), detailsRow);

                if (row.child.isShown()) {
                    tr.removeClass('details')
                    row.child.hide()
                    detailsRow.splice(idx, 1)
                } else {
                    tr.addClass('details')
                    row.child(format(row.data())).show()
                    if (idx === -1) {
                        detailsRow.push(tr.attr('id'))
                    }
                }
            })

            table.on('draw', function() {
                $.each(detailsRow, function(i, id) {
                    $('#' + id + ' td.details-control').trigger('click')
                })
            })

            function format(d) {
                var html = ` <h6> Daftar Informasi Barang yg Dibawa Keluar </h6>
                    <table class = "table table-sms">
                                                <tr class = "bg-light">
                                                <td> Nama Barang </td>
                                                <td> Jumlah </td>
                                                <td> Satuan </td>
                                                <td> Tgl Kembali </td>
                                                <td> Konfirmasi </td>
                                                </tr>`
                for (let i = 0; i < d.barang.length; i++) {
                    html += `<tr>
                                    <td>${d.barang[i].nama_barang}</td>
                                    <td>${d.barang[i].jumlah}</td>
                                    <td>${d.barang[i].satuan}</td>
                                    <td>${d.barang[i].tgl_kembali.substring(0,10)}</td>`
                    if (d.barang[i].keterangan_kembali == 0) {
                        html +=
                            `<td><button class="btn btn-sm btn-confirm btn-success" data-regis="${d.barang[i].id}">Konfirmasi</button></td>`
                    } else {
                        html +=
                            `<td>Selesai</td>`
                    }
                    html += `</tr>`
                }

                html += `</table>`

                return html
            }


            $('.table tbody').on('click', '.btn-confirm', function() {
                if (confirm('Apakah anda yakin barang ini sudah kembali?')) {
                    // console.log($(this).data('regis'))
                    $.ajax({
                        url: "{{ route('website.izin.confirm_ajax') }}",
                        method: 'get',
                        data: {
                            'id_barang': $(this).data('regis')
                        },
                        success: function(data, status, xhr) {
                            toastr['success'](data)
                            table.ajax.reload()
                        },
                        error: function(xhr, status, errorMessage) {
                            toastr['error'](errorMessage)
                            console.log(xhr)
                            console.log(status)
                            console.log(errorMessage)
                        }
                    })
                }
            })
        })
    </script>
@endpush
