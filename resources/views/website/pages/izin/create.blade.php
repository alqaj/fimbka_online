@extends('website.layouts.main')
@section('title', 'Homepage')

@section('content')
    <h3>Buat Izin Mengeluarkan Barang</h3>
    <br />
    <form id="form" method="post" action="{{ route('website.izin.store') }}">
        @csrf
        <div class="mb-3 row">
            <label for="message" class="col-sm-2 col-form-label">Tujuan Pekerjaan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="tujuan_pekerjaan" />
            </div>
        </div>
        <div class="mb-3 row">
            <label for="message" class="col-sm-2 col-form-label">Alamat Tujuan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="tujuan_alamat" />
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Kembali/Tidak</label>
            <div class="col-sm-10">
                <select class="form-control" name="jenis_kembali">
                    <option>Barang Kembali</option>
                    <option>Barang Tidak Kembali</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Kategori Keluar</label>
            <div class="col-sm-10">
                <select class="form-control" name="kategori_keluar">
                    <option>Pinjam Barang</option>
                    <option>Repair</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Jenis Barang</label>
            <div class="col-sm-10">
                <select class="form-control" name="jenis_barang">
                    <option>Laptop/PC</option>
                    <option>Printer</option>
                    <option>Lainnya</option>
                </select>
            </div>
        </div>
        <div class="mt-5 row border bg-light">
            <label for="message" class="col-sm-4 col-form-label">Nama Barang/ Kode Barang</label>
            <label for="message" class="col-sm-1 col-form-label">Jumlah</label>
            <label for="message" class="col-sm-1 col-form-label">Satuan</label>
            <label for="message" class="col-sm-2 col-form-label">Tgl Kembali</label>
            <label for="message" class="col-sm-2 col-form-label">Keterangan</label>
        </div>
        <div id="dynamic-row" class="">
            <div class="row border p-2">
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="nama_barang[]" required />
                </div>
                <div class="col-sm-1">
                    <input type="number" class="form-control" name="jumlah[]" min="1" required />
                </div>
                <div class="col-sm-1">
                    <input type="text" class="form-control" name="satuan[]" required />
                </div>
                <div class="col-sm-2">
                    <input type="date" class="form-control date-input" name="tgl_kembali[]" required />
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="keterangan[]">
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-light border btn-sm btn-tambah">Tambah Baris</button>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-3">
                <button class="btn btn-primary btn-lg btn-block">Submit Form Izin</button>
            </div>
        </div>
    </form>
@endsection

@push('styles')
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {

            @if (session()->has('success'))
                toastr['success']("{{ Session('success') }}")
            @endif


            $('#dynamic-row').on('click', '.btn-tambah', function() {
                const html = `
            <div class="row border p-2">
            <div class="col-sm-4">
                <input type="text" class="form-control" name="nama_barang[]" required />
            </div>
            <div class="col-sm-1">
                <input type="number" class="form-control" name="jumlah[]" min="1" required />
            </div>
            <div class="col-sm-1">
                <input type="text" class="form-control" name="satuan[]" required />
            </div>
            <div class="col-sm-2">
                <input type="date" class="form-control date-input" name="tgl_kembali[]" required/>
            </div>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="keterangan[]">
            </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-danger btn-sm btn-hapus" data-company="astra">Hapus Baris</button>
                </div>
            </div>`
                $('#dynamic-row').prepend(html);

            })

            $('#dynamic-row').on('click', '.btn-hapus', function() {
                if (confirm('Hapus baris ini?'))
                    $(this).parent().parent().remove()
            })

            $('#dynamic-row').on('click', '.date-input', function() {
                var today = new Date();
                var maxDate = new Date(today.getFullYear(), today.getMonth() + 3, today.getDate());
                var formattedMaxDate = maxDate.toISOString().split('T')[0];
                $(this).attr('max', formattedMaxDate);
            })

        })
    </script>
@endpush
