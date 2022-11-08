@extends('layouts/header')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin</h1>
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
                <form role="form" action="{{route('user_admin.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Username">Username</label>
                            <input name="username" type="text" class="form-control" id="Username"
                                placeholder="Username" required value="{{ old('username') }}">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" type="password" class="form-control" id="password"
                                placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label for="Nama">Nama</label>
                            <input name="nama" type="text" class="form-control" id="Nama"
                                placeholder="Nama" required value="{{ old('nama') }}">
                        </div>
                        <div class="form-group">
                            <label for="nomor_telepon">Nomor Telepon</label>
                            <input name="nomor_telepon" type="text" class="form-control" id="nomor_telepon"
                                placeholder="Nomor Telepon (cth: 08xxxxxxxxxx)" required value="{{ old('nomor_telepon') }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control" id="email"
                                placeholder="Email" required value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="Tempat Lahir">Tempat Lahir</label>
                            <input name="tempat_lahir" type="text" class="form-control" id="TempatLahir"
                                placeholder="Tempat Lahir" required value="{{ old('tempat_lahir') }}">
                        </div>
                        <div class="form-group">
                            <label for="Tanggal Lahir">Tanggal Lahir</label>
                            <input name="tanggal_lahir" type="date" class="form-control" id="TanggalLahir"
                                placeholder="Tanggal Lahir" required value="{{ old('tanggal_lahir') }}">
                        </div>
                        <div class="form-group">
                            <label for="Judul Berita">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="P">Perempuan</option>
                                <option value="L">Laki-laki</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Alamat Rumah">Alamat Rumah</label>
                            <input name="alamat_rumah" type="text" class="form-control" id="alamat_rumah"
                                placeholder="Alamat Rumah" required value="{{ old('alamat_rumah') }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('user_admin.index') }}"><button id="buttonCancel" type="button"
                            class="btn btn-default">Cancel</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- /.content-header -->
</div>
@endsection
