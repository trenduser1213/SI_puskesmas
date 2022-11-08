@extends('layouts/header')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Obat</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
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
                @if(session('error_message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        </button>
                        <strong>Opps!</strong> {{ session('error_message') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form role="form" action="{{route('obat.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Judul Berita">Kode Obat</label>
                            <input name="kode" type="text" class="form-control" id="KodeObat"
                                placeholder="Kode Obat">
                        </div>
                        <div class="form-group">
                            <label>Kategori Obat</label>
                            <select name="kategori_obat_id" class="form-control">
                                @foreach ($kategori_obat as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Judul Berita">Nama Obat</label>
                            <input name="nama" type="text" class="form-control" id="NamaObat"
                                placeholder="Nama Obat">
                        </div>
                        <div class="form-group">
                            <label for="Judul Berita">Dosis Obat</label>
                            <input name="dosis" type="text" class="form-control" id="DosisObat"
                                placeholder="Dosis Obat">
                        </div>
                        <div class="form-group">
                            <label for="Judul Berita">Harga Obat</label>
                            <input name="harga" type="text" class="form-control" id="HargaObat"
                                placeholder="Harga Obat">
                        </div>
                        <div class="form-group">
                            <label for="Judul Berita">Tanggal Produksi Obat</label>
                            <input name="tanggal_produksi" type="date" class="form-control" id="TanggalProduksi"
                                placeholder="Tanggal Produksi Obat">
                        </div>
                        <div class="form-group">
                            <label for="Judul Berita">Tanggal Kadaluarsa Obat</label>
                            <input name="tanggal_kadaluarsa" type="date" class="form-control" id="TanggalKadaluarsa"
                                placeholder="Tanggal Kadaluarsa Obat">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('obat.index') }}"><button id="buttonCancel" type="button"
                            class="btn btn-default">Cancel</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- /.content-header -->
</div>
@endsection