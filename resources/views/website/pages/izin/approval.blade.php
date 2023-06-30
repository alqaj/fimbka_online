@extends('website.layouts.main')

@section('content')
    <h3 id="title">Approval Izin Mengeluarkan Barang</h3>
    <br>
    <div class="table-responsive">
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
    </div>
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

            const url = window.location.href;
            const paramValue = new RegExp("[?&]link=([^&#]*)").exec(url);
            const link = paramValue ? decodeURIComponent(paramValue[1]) : null;

            $('#title').append(`(${link.toUpperCase()})`)


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
                    'url': "{{ route('website.izin.ajax_show_approval') }}",
                    data: {
                        link: link
                    },
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
                                                <td> Keterangan </td>
                                                </tr>`
                for (let i = 0; i < d.barang.length; i++) {
                    html += `<tr>
                                    <td>${d.barang[i].nama_barang}</td>
                                    <td>${d.barang[i].jumlah}</td>
                                    <td>${d.barang[i].satuan}</td>
                                    <td>${d.barang[i].tgl_kembali.substring(0,10)}</td>
                                    <td>${d.barang[i].keterangan}</td>
                                </tr>`
                }

                html += `</table>`
                html += `<button class="btn btn-success btn-sm btn-approve" data-reg="${d.reg_no}">Approve</button>`
                html +=
                    `<button class="btn btn-danger btn-sm ms-2 btn-reject" data-reg="${d.reg_no}">Reject</button>`
                return html
            }

            $('.table tbody').on('click', '.btn-approve', function() {
                if (confirm('Apakah anda yakin ingin meng-Approve ini?')) {
                    console.log($(this).data('reg'))
                    $.ajax({
                        'url': "{{ route('website.izin.approve_ajax') }}",
                        'data': {
                            'link': link,
                            'reg_no': $(this).data('reg')
                        },
                        success: function(data, status, xhr) {
                            toastr['success'](data)
                            table.ajax.reload()
                        },
                        error: function(xhr, status, errorMessage) {
                            console.log(xhr)
                            console.log(status)
                            toastr['error'](errorMessage)
                        }
                    })
                }
            })
        })
    </script>
@endpush
