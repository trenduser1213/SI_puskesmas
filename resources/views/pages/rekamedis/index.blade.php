@extends('layouts/header_dokter')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Rekamedis</h1>
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
                    <a href="{{route('rekamedis.create')}}"><button type="button" id="buttonTambahKategoriObat" class="btn btn-block btn-primary">Tambah
                        Rekamedis</button></a>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal Pendaftaran</th>
                            <th>Diagnosa</th>
                            <th>Tindakan</th>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekamedis as $item)
                        <tr>
                            <td>{{$item->tanggal_pendaftaran}}</td>
                            <td>{{$item->diagnosa}}</td>
                            <td>{{$item->tindakan}}</td>
                            <td>{{$item->pasien->nama}}</td>
                            <td>{{$item->dokter->nama}}</td>
                            <td>
                                <a href="{{route('rekamedis.edit', $item->id)}}">
                                    <button type="button" class="btn btn-warning">Update</button>
                                </a>
                                <form style="margin-top: 5px;display:inline-block;" action="{{route('rekamedis.destroy', $item->id)}}"
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
