@extends('layouts/header')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kategori Obat</h1>
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
        <div class="card">
            <div class="row card-header">
                <div class="col-sm-2 col-12">
                    <a href="{{route('obat.create')}}"><button type="button" id="buttonTambahKategoriObat" class="btn btn-block btn-primary">Tambah
                        Obat</button></a>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Kategori Obat</th>
                            <th>Nama</th>
                            <th>Dosis</th>
                            <th>Harga</th>
                            <th>Tanggal Produksi</th>
                            <th>Tanggal Kadaluarsa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($obat as $item)
                        <tr>
                            <td>{{$item->kode}}</td>
                            <td>{{$item->kategori_obat->nama}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->dosis}}</td>
                            <td>{{$item->harga}}</td>
                            <td>{{$item->tanggal_produksi}}</td>
                            <td>{{$item->tanggal_kadaluarsa}}</td>
                            <td>
                                <a href="{{route('obat.edit', $item->id)}}">
                                    <button type="button" class="btn btn-warning">Update</button>
                                </a>
                                <form style="margin-top: 5px;display:inline-block;" action="{{route('obat.destroy', $item->id)}}"
                                    method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- /.content-header -->
</div>
@endsection
