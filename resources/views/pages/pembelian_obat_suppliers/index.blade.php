@extends('layouts/header')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pembelian Obat Supplier</h1>
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
                    <a href="{{route('pembelian_obat_suppliers.create')}}"><button type="button" id="tambah_pembelian_obat_supplier" class="btn btn-block btn-primary">Tambah Data</button></a>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kode Obat</th>
                            <th>Nama Obat</th>
                            <th>Stok Obat</th>
                            <th>Sisa Obat</th>
                            <th>Tanggal Produksi</th>
                            <th>Tanggal Kadaluarsa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp

                        @foreach ($pembelian_obat_suppliers as $item)
                        <tr>
                            <td>{{$i}}</td>
                            @php
                                $i++;
                            @endphp
                            <td>{{$item->obat->kode}}</td>
                            <td>{{$item->obat->nama}}</td>
                            <td>{{$item->stok}}</td>
                            <td>{{$item->sisa_obat}}</td>
                            <td>{{$item->tanggalproduksi}}</td>
                            <td>{{$item->tanggalkadaluarsa}}</td>
                            <td>
                                <a href="{{route('pembelian_obat_suppliers.edit', $item->id)}}">
                                    <button type="button" class="btn btn-warning">Update</button>
                                </a>
                                <form style="margin-top: 5px;display:inline-block;" action="{{route('pembelian_obat_suppliers.destroy', $item->id)}}"
                                    method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                {{-- <a href="{{route('obat.edit', $item->id)}}">
                                    <button type="button" class="btn btn-warning">Update</button>
                                </a>
                                <form style="margin-top: 5px;display:inline-block;" action="{{route('obat.destroy', $item->id)}}"
                                    method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form> --}}
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

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
{{-- <script>

        $(function() {
            let table = new DataTable('#example1', {
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                // 
            });
        });
</script> --}}


@endsection
