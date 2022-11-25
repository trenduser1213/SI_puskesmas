@extends('layouts/header_dokter')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Update Rekam Medis</h1>
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
                <form role="form" action="{{route('rekamedis.update', $rekamedis->id)}}" method="POST">
                    @csrf @method("PUT")
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Judul Berita">Tanggal Pendaftaran</label>
                            <input name="tanggal_pendaftaran" type="date" class="form-control" id="tanggal_pendaftaran"
                                placeholder="Tanggal Pendaftaran" value="{{$rekamedis->tanggal_pendaftaran}}">
                        </div>
                        <div class="form-group">
                            <label>Diagnosa</label>
                            <input name="diagnosa" type="text" class="form-control" id="diagnosa"
                                placeholder="Diagnosa" value="{{$rekamedis->diagnosa}}">
                        </div>
                        <div class="form-group">
                            <label for="Tindakan">Tindakan</label>
                            <textarea name="tindakan" type="text" rows="2" class="form-control" id="Tindakan"
                                placeholder="Tindakan" value="{{$rekamedis->tindakan}}">{{$rekamedis->tindakan}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="Judul Berita">Pasien</label>
                            <select name="pasien_id" class="form-control">
                                @foreach ($pasien as $item)
                                    <option value="{{$item->users->id}}" {{ $rekamedis->pasien_id  == $item->users->id ? 'selected' : ''}}>{{$item->users->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Judul Berita">Dokter</label>
                            <select name="dokter_id" class="form-control">
                                @foreach ($dokter as $item)
                                    <option value="{{$item->users->id}}" {{ $rekamedis->pasien_id  == $item->users->id ? 'selected' : ''}}>{{$item->users->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{route('rekamedis.index')}}">
                            <button id="buttonCancel" type="button"
                            class="btn btn-default">Cancel</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header"><div class="pl-4">Rujukan</div></div>
            <div class="card-body">
                <div class="card-body">
                    @if(!$rekamedis->rujukans->isEmpty())
                        <div class="row">
                            <div class="col-6 row">
                                <div class="col-4">Kode Rujukan</div>
                                <div class="mr-2">:</div>
                                <div class="">{{ $rekamedis->rujukans->last()->kode }}</div>
                            </div>
                            <div class="col-6 row">
                                <div class="col-4">Jenis Pemeriksaan</div>
                                <div class="mr-2">:</div>
                                <div class="">{{ $rekamedis->rujukans->last()->jenis_pemeriksaan }}</div>
                            </div>
                            <div class="col-6 row">
                                <div class="col-4">Tempat Rujukan</div>
                                <div class="mr-2">:</div>
                                    <div class="">{{ $rekamedis->rujukans->last()->tempatrujukan->nama }}</div>
                            </div>
                            <div class="col-6 row">
                                <div class="col-4">Tgl. Berkunjung</div>
                                <div class="mr-2">:</div>
                                <div class="">{{ date('d F Y', strtotime($rekamedis->rujukans->last()->tglberkunjung)) }}</div>
                            </div>
                        </div>
                        <div class="pt-4">
                            <div class="btn btn-primary" data-toggle="modal" data-target="#edit-rujuk{{$rekamedis->id}}">edit</div>
                            <form style="margin-top: 5px;display:inline-block;" action="{{route('dokterrujukan.destroy', $rekamedis->rujukans->last()->id)}}"
                                method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                        <div class="modal fade" id="edit-rujuk{{$rekamedis->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambahkan Rujukan</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('dokterrujukan.update',$rekamedis->rujukans->last()->id) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="modal-body">
                                        {{-- <div class="card-body"> --}}
                                            {{-- {{ Form::hidden( 'rekamedis',$rekamedis->id,) }} --}}
                                            <div class="form-group">
                                                <label for="kode">Kode</label>
                                                <input name="kode" type="text" class="form-control" id="kode"
                                                placeholder="Masukkan kode pasien" required value="{{ $rekamedis->rujukans->last()->kode }} {{ old('kode') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_pemeriksaan">Jenis Pemeriksaan</label>
                                                <input name="jenis_pemeriksaan" type="text" class="form-control" id="jenis_pemeriksaan"
                                                placeholder="Masukkan Jenis Pemeriksaan" required value="{{ $rekamedis->rujukans->last()->jenis_pemeriksaan }} {{ old('jenis_pemeriksaan') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_berkunjung">Tanggal Berkunjung</label>
                                                <input name="tgl_berkunjung" type="date" class="form-control" id="tgl_berkunjung"
                                                placeholder="Masukkan Jenis Pemeriksaan" required value="{{ $rekamedis->rujukans->last()->kode }}{{ old('tgl_berkunjung') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="tempat_rujukan_id">Tempat Rujukan</label>
                                                <select name="tempat_rujukan_id" class="form-control">
                                                    <option value="-" selected disabled>Pilih Tempat Rujukan</option>
                                                    @foreach($tempat as $tempat_rujukan)
                                                        @if($tempat_rujukan->id == $rekamedis->rujukans->last()->tempatrujukan->id)
                                                        <option selected value="{{ $tempat_rujukan->id }}">{{ $tempat_rujukan->nama }}</option> 
                                                        @else
                                                        <option value="{{ $tempat_rujukan->id }}">{{ $tempat_rujukan->nama }}</option>                                                            
                                                        @endif
                                                    @endforeach
                                                    {{-- <option value="L">Laki-laki</option> --}}
                                                </select>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    @else
                        <div class="btn btn-primary" data-toggle="modal" data-target="#rujuk{{$rekamedis->id}}">Tambahkan Rujukan</div>
                        <!-- Modal -->
                        <div class="modal fade" id="rujuk{{$rekamedis->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambahkan Rujukan</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form role="form" action="{{ route('dokterrujukan.store') }}" method="POST">
                                    @csrf
                                    @method('post')
                                    <div class="modal-body">
                                        {{-- <div class="card-body"> --}}
                                            {{ Form::hidden( 'rekamedis',$rekamedis->id,) }}
                                            <div class="form-group">
                                                <label for="kode">Kode</label>
                                                <input name="kode" type="text" class="form-control" id="kode"
                                                placeholder="Masukkan kode pasien" required value="{{ old('kode') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_pemeriksaan">Jenis Pemeriksaan</label>
                                                <input name="jenis_pemeriksaan" type="text" class="form-control" id="jenis_pemeriksaan"
                                                placeholder="Masukkan Jenis Pemeriksaan" required value="{{ old('jenis_pemeriksaan') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_berkunjung">Tanggal Berkunjung</label>
                                                <input name="tgl_berkunjung" type="date" class="form-control" id="tgl_berkunjung"
                                                placeholder="Masukkan Jenis Pemeriksaan" required value="{{ old('tgl_berkunjung') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="tempat_rujukan_id">Tempat Rujukan</label>
                                                <select name="tempat_rujukan_id" class="form-control">
                                                    <option value="-" selected disabled>Pilih Tempat Rujukan</option>
                                                    @foreach($tempat as $tempat_rujukan)
                                                        <option value="{{ $tempat_rujukan->id }}">{{ $tempat_rujukan->nama }}</option>
                                                    @endforeach
                                                    {{-- <option value="L">Laki-laki</option> --}}
                                                </select>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="card-body">
                    <form role="form" action="{{ route($rekamedis->resep_obat_id ? 'resep_obat.update' : 'rekamedis.store', $rekamedis->resep_obat_id ?: []) }}" method="POST">
                        @csrf
                        @if(!$rekamedis->resep_obat_id)
                            <input type="hidden" name="rekam_medis_id" value="{{ $rekamedis->id }}">
                        @else
                            @method('PUT')
                        @endif
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Judul Berita">Kode Resep Obat</label>
                                <input name="kode" type="text" class="form-control" id="KoderesepObat"
                                       placeholder="Kode resep Obat" value="{{ $rekamedis->resepobat ? $rekamedis->resepobat->kode : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="Judul Berita">Tanggal Resep Obat</label>
                                <input name="tanggal_resep" type="date" class="form-control" id="resepObat"
                                       placeholder="Nama resep" value="{{ $rekamedis->resepobat ? $rekamedis->resepobat->tanggal_resep : '' }}">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ $rekamedis->resep_obat_id ? 'Edit' : 'Tambah' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($rekamedis->resep_obat_id)
        <div class="container">
            <div class="card">
                <div class="row card-header">
                    <div class="col-sm-2 col-12 ml-auto">
                        <button type="button" id="buttonTambahresepObat" class="btn btn-block btn-success" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i>Tambah Obat</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Obat</th>
                                <th>Keterangan Obat</th>
                                <th>Jumlah Obat</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $n = 1;
                            @endphp
                            @if(($rekamedis->resepobat != null) && (!$rekamedis->resepobat->resepobatdetails->isEmpty()))
                                @foreach ($rekamedis->resepobat->resepobatdetails as $item)
                                <tr>
                                    <td>{{ $n++ }}</td>
                                    <td>{{ $item->obat->nama }}</td>
                                    <td>{{ $item->keterangan_obat }}</td>
                                    <td>{{ $item->jumlah_obat }}</td>
                                    <td>
                                        <button type="button" id="buttonTambahresepObat" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-{{ $item->id }}">Update</button>
                                        <form style="margin-top: 5px;display:inline-block;" action="{{ route('resep_obat_detail.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-edit-{{ $item->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Obat</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form role="form" action="{{ route('resep_obat_detail.update', $item->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <div class="modal-body">
                                                    <input type="hidden" id="id" name="id"
                                                           value="{{ $item->id_resep_obat }}">
                                                    <div class="form-group">
                                                        <label for="Judul Berita">Pilih Obat</label>
                                                        <select name="obat_id" id="obat_id" class="form-control">
                                                            @foreach ($obats as $obat)
                                                                @if ($obat->id === $item->id_obat)
                                                                    <option value="{{ $obat->id }}" selected>
                                                                        {{ $obat->nama }}</option>
                                                                @else
                                                                    <option value="{{ $obat->id }}">
                                                                        {{ $obat->nama }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Judul Berita">Keterangan</label>
                                                        <input name="keterangan_obat" type="text" class="form-control"
                                                               id="resepObat" placeholder="Masukkan Keterangan Obat"
                                                               value="{{ $item->keterangan_obat }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Judul Berita">Jumlah Obat</label>
                                                        <input name="jumlah_obat" type="text" class="form-control"
                                                               id="resepObat" placeholder="Masukkan Jumlah Obat"
                                                               value="{{ $item->jumlah_obat }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="modal fade" id="modal-default">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Obat</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form role="form" action="{{ route('resep_obat_detail.store', $rekamedis->resep_obat_id) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" id="resep_obat_id" name="id" value="{{ $rekamedis->resep_obat_id }}">
                                        <div class="form-group">
                                            <label for="id_obat">Pilih Obat</label>
                                            <select name="obat_id" id="obat_id" class="form-control">
                                                @foreach ($obats as $obat)
                                                    <option value="{{ $obat->id }}">{{ $obat->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan_obat">Keterangan</label>
                                            <input name="keterangan_obat" type="text" class="form-control" id="resepObat" placeholder="Masukkan Keterangan Obat">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_obat">Jumlah Obat</label>
                                            <input name="jumlah_obat" type="text" class="form-control" id="resepObat" placeholder="Masukkan Jumlah Obat">
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- /.content-header -->
</div>
@endsection
