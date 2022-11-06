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
                <form role="form" action="{{route('rekamedis.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Judul Berita">Tanggal Pendaftaran</label>
                            <input name="tanggal_pendaftaran" type="date" class="form-control" id="tanggal_pendaftaran"
                                placeholder="Tanggal Pendaftaran">
                        </div>
                        <div class="form-group">
                            <label>Diagnosa</label>
                            <input name="diagnosa" type="text" class="form-control" id="diagnosa"
                                placeholder="Diagnosa">
                        </div>
                        <div class="form-group">
                            <label for="Tindakan">Tindakan</label>
                            <textarea name="tindakan" type="text" rows="2" class="form-control" id="Tindakan"
                                placeholder="Tindakan"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Judul Berita">Pasien</label>
                            <select name="pasien_id" class="form-control">
                                @foreach ($pasien as $item)
                                    <option value="{{$item->users->id}}">{{$item->users->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Dokter">Dokter</label>
                            <select name="dokter_id" class="form-control">
                                @foreach ($dokter as $item)
                                <option value="{{$item->users->id}}">{{$item->users->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('rekamedis.index') }}"><button id="buttonCancel" type="button"
                            class="btn btn-default">Cancel</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- /.content-header -->
</div>
@endsection
