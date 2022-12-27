@extends('layouts/header_pasien')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pendaftaran Pasien</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
               <div class="row">
                <div class="col-md-2"><strong>Spesialis</strong> </div>
                <div class="col-md-2">: {{ucfirst($dataspesialis->nama)}}</div>
               </div>

               <div class="row">
                <div class="col-md-2"><strong>Tanggal</strong> </div>
                <div class="col-md-2">: {{\Carbon\Carbon::parse($tanggal)->format('d F Y')}}</div>
               </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($jadwalDokter as $item)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 pl-4">
                                        @if ($item->dokter->jenis_kelamin=="P")
                                            <img src="{{ asset('/icon/dokterwanita.png') }}" width="100px" height="100px">
                                        @else
                                            <img src="{{ asset('/icon/doktercowo.png') }}" width="100px" height="100px">
                                        @endif
                                    </div>
                                    <div class="col-md-6" >
                                         <h4 style="font-size:98%"><i>{{$dataspesialis->nama}}</i></h4>
                                         <h3 class="text-blue"><strong>{{ucfirst($item->dokter->nama)}}</strong></h3>
                                         <h4 style="font-size:98%"><i>{{$dataspesialis->nama}}</i></h4>
                                    </div>
                                </div>
                                 
                                <div class="row">
                                    <div class="col-md-12">
                                       <hr style="color:rgb(28, 5, 5)">
                                    </div>  
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <h5>{{$item->waktu_mulai}} -  {{$item->waktu_selesai}}</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <p> | </p>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>{{$item->stok==0 ? '<i>Tidak Ada Batasan Kuota</i>' : 'Kuota : ' . $item->stok}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5>Jumlah Pasien Saat Ini : {{$item->nomor_antrian ? $item->nomor_antrian : 0}}</h5>
                                    </div>  
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                       <hr style="color:rgb(28, 5, 5)">
                                    </div>  
                                </div>                                                                
                                        <!-- Button trigger modal -->
                                        @if ($item->status == 'error waktu')
                                            <h6 class="text-center"><i>Tidak Tersedia Sekarang</i></h6>
                                        @elseif($item->status == 'error stok')
                                            <h6  class="text-center"><i>Kuota Sudah Penuh</i></h6>
                                        @else
                                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#noantrian{{$item->id}}">
                                                Ambil Antrian
                                            </button>
                                        @endif
                                     

                                        <form action="{{ route('pasien.daftar') }}" method="POST">
                                            @csrf
                                            <!-- Modal -->
                                            <div class="modal fade" id="noantrian{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Pendaftaran Pasien</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                @if ($item->dokter->jenis_kelamin=="P")
                                                                    <img src="{{ asset('/icon/dokterwanita.png') }}" width="100px" height="100px">
                                                                @else
                                                                    <img src="{{ asset('/icon/doktercowo.png') }}" width="100px" height="100px">
                                                                @endif
                                                            </div>
                                                            <div class="col-md-8" >
                                                                 <h4 style="font-size:98%"><i>{{$dataspesialis->nama}}</i></h4>
                                                                 <h3 class="text-blue"><strong>{{ucfirst($item->dokter->nama)}}</strong></h3>
                                                                 <h4 style="font-size:98%"><i>{{$dataspesialis->nama}}</i></h4>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                               <hr style="color:rgb(28, 5, 5)">
                                                            </div>  
                                                        </div>

                                                        <div class="row mt-2">
                                                            <div class="col-md-6">
                                                                <h5>{{$item->waktu_mulai}} -  {{$item->waktu_selesai}}</h5>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <p> | </p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h5>{{$item->stok==0 ? '<i>Tidak Ada Batasan Kuota</i>' : 'Kuota : ' . $item->stok}}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                               <hr style="color:rgb(28, 5, 5)">
                                                            </div>  
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Tipe Pembayaran</label>
                                                            <select name="tipe_pembayaran" class="form-control" id="" required>
                                                                <option value="umum" selected>Umum</option>
                                                            </select>

                                                            <input type="hidden" name="nomor_antrian" value="{{$item->nomor_antrian}}">
                                                            <input type="hidden" name="hari" value="{{$item->hari}}">
                                                            <input type="hidden" name="dokter_id" value="{{$item->dokter_id}}">
                                                            <input type="hidden" name="spesialis_id" value="{{$item->dokter->userspesialis[0]->spesialis_id}}">
                                                            <input type="hidden" name="tanggal" value="{{$tanggal}}">
                                                            <input type="hidden" name="jadwal_id" value="{{$item->id}}">

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">                                                    
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#noantrian2{{$item->id}}" onclick="hideModal({{$item->id}})">
                                                         Ambil Antrian
                                                        </button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>      
                                        
                                           <!-- Modal -->
                                            <div class="modal fade" id="noantrian2{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Syarat & Ketentuan Antrian Online</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">                                                                                                            
                                                            <p>Saya bersedia datang <b>30 menit sebelum dilayani</b> atau 
                                                               <b>10 pasien sebelum saya dilayani</b>. Apabila saya terlambat, saya bersedia diperlakukan
                                                               sesuai kebijakan klinik.  
                                                            </p>
                                                            <input type="checkbox" required>
                                                            <label for="">Saya Setuju</label>
                                                        </div>
                                                        <div class="modal-footer">
                                                            
                                                            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#noantrian" >
                                                            Ambil Antrian
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>      
                                         </form>
                               
                            </div>
                        </div>
                    </div>
                    @endforeach
                   
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
        function hideModal(id) {
            console.log('tes');
            $('#noantrian' + id).modal('hide');
        }
    </script>
@endsection
