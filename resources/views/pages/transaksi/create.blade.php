@extends('layouts/header')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Transaksi</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <strong>Success!</strong> {{ $message }}
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> {{ $message }}
            </div>
        @endif
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Obat</th>
                                    <th>Kategori Obat</th>
                                    <th>Jumlah Obat</th>
                                    <th>Keterangan Obat</th>
                                    <th>Harga Obat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                </tr>
        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form role="form" action="{{route('transaksi.store')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Kode">No Registrasi</label>
                                    <input name="no_regis" type="text" class="form-control" id="kode"
                                        placeholder="Kode Spesialis">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Tanggal Periksa</label>
                                    <input name="tanggal_periksa" type="date" class="form-control" id="nama"
                                        placeholder="Nama Spesialis">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Tanggal Bayar</label>
                                    <input name="tanggal_bayar" type="date" class="form-control" id="nama"
                                        placeholder="Nama Spesialis">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Total</label>
                                    <input name="total" type="text" class="form-control" id="total"
                                        placeholder="Total Biaya">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Jasa Dokter</label>
                                    <input name="jasa_dokter" type="text" class="form-control" id="nama"
                                        placeholder="Jasa Dokter">
                                </div>

                                <div class="form-group">
                                    <label for="nama">Grand Total</label>
                                    <input name="grandtotal" type="text" class="form-control" id="grandtotal"
                                        placeholder="Grand Total">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Jumlah Bayar</label>
                                    <input name="junlah_bayar" type="text" class="form-control" id="jumlahbayar"
                                        placeholder="Jumlah Bayar">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Kembalian</label>
                                    <input name="nama" type="text" class="form-control" id="kembalian"
                                        placeholder="Kembalian">
                                </div>
                                
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info btn-rounded">Konfirmasi Pembayaran</button>
                                <a href="{{ route('spesialis.index') }}"><button id="buttonCancel" type="button"
                                    class="btn btn-default">Cancel</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       
    </div>

    <!-- /.content-header -->
</div>
@endsection
