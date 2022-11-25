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
                    <div class="card-header">
                        <h4>List Resep Obat : </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Obat</th>
                                    <th>Kategori Obat</th>
                                    <th>Jumlah Obat</th>
                                    <th>Keterangan Obat</th>
                                    <th>Status Stok</th>
                                    <th>Harga Obat (Rp.)</th>
                                    <th>Subtotal (Rp.)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resepObat as $item)
                                <tr>
                                    <td>{{$item->obat->nama}}</td>
                                    <td>{{$item->obat->kategori_obat->nama}}</td>
                                    <td>{{$item->jumlah_obat}}</td>
                                    <td>{{$item->keterangan_obat}}</td>
                                    <td><i>{{
                                              $count=  explode(" ",$item->jumlah_obat);
                                              if ($count[0] > $item->obat->stok) {
                                                 echo "Stok Kurang";
                                              }else {
                                                 echo "Stok Ada";
                                              }
                                        
                                        }}</i></td>
                                    <td> {{ number_format($item->obat->harga, 0, ',', '.') }}</td>
                                    <td>{{ number_format((int)$item->obat->harga * (int)$item->jumlah_obat, 0, ',', '.') }} </td>

                                </tr>
                                @endforeach
                                <tr>
                                    <th colspan="5" class="text-left">Total (Rp.)</th>
                                    <td colspan="1">{{ number_format($total, 0, ',', '.') }}</td>
                                </tr>
                               
        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Transaksi : </h4>
                    </div>
                    <div class="card-body">
                        <form role="form" action="{{route('transaksi.store')}}" method="POST">
                            @csrf
                            <input type="hidden" name="rekammedis_id" value="{{$rekammedis->id}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Kode">No Registrasi</label>
                                    <input name="no_regis" type="text" class="form-control" id="kode"
                                        placeholder="No Registrasi">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Tanggal Periksa</label>
                                    <input name="tanggal_periksa" type="date" class="form-control" id="nama"
                                         required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Tanggal Bayar</label>
                                    <input name="tanggal_bayar" type="date" class="form-control" id="nama"
                                         required >
                                </div>
                                <div class="form-group">
                                    <label for="nama">Total</label>
                                    <input name="total" type="text" class="form-control" id="total"
                                        value="{{number_format($total, 0, ',', '.')}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Jasa Dokter</label>
                                    <input name="jasa_dokter" type="number" class="form-control" id="jasadokter"
                                        placeholder="Jasa Dokter" value="0" required >
                                </div>

                                <div class="form-group">
                                    <label for="nama">Grand Total</label>
                                    <input name="grandtotal" type="text" class="form-control" id="grandtotal"
                                        placeholder="Grand Total"  readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Jumlah Bayar</label>
                                    <input name="jumlah_bayar" type="number" class="form-control" id="jumlahbayar"
                                        placeholder="Jumlah Bayar" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Kembalian</label>
                                    <input name="kembalian" type="text" class="form-control" id="kembalian"
                                        placeholder="Kembalian" readonly>
                                </div>
                                
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info btn-rounded">Konfirmasi Pembayaran</button>
                                <a href="{{ route('transaksi.index') }}"><button id="buttonCancel" type="button"
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

@section('js')
<script>    
     let total = 0 ; 
     let kembalian = 0
     let i = 0;
     $(document).ready(function() {

        $("#jasadokter").change(function(params){

             jasadokter = $('#jasadokter').val();
             console.log(jasadokter);
             total = {{$total}} + parseInt(jasadokter);
             $('#grandtotal').val(total);

             jumlahbayar = $('#jumlahbayar').val();
             kembalian = parseInt(jumlahbayar) - total;
             $('#kembalian').val(kembalian);
        });

        $("#jumlahbayar").change(function(params){
             jumlahbayar = $('#jumlahbayar').val();
             if (jumlahbayar < total) {
                alert('Pembayaran kurang dari total pembayaran')
             }
             kembalian = parseInt(jumlahbayar) - total;
             $('#kembalian').val(kembalian);

             jasadokter = $('#jasadokter').val();
             total = {{$total}} + parseInt(jasadokter);
             $('#grandtotal').val(total);
        });    
     });
</script>
@endsection
