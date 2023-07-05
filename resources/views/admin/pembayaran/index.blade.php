@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Pembayaran</h2>
                </div>
                <div class="col">
                    <a href="{{route('admin-create-pembayaran', ['id' => $iuran_id])}}"><button type="button" class="btn cur-p btn-lg btn-primary mr-3" style="float: right;">Tambah</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" class="bg-transparent" style="background-color:transparent;">
        <li class="breadcrumb-item"><u class="blue1_color"><a class="blue1_color" href="{{route('admin-view-pembayaran-pilih-iuran')}}">Pilih Iuran</a></u></li>
        <li class="breadcrumb-item active" aria-current="page">List Pembayaran</li>
    </ol>
</nav>
<div class="row column3 graph margin_bottom_30">
    <div class="col-md-l2 col-lg-12">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                <h2>Pilih Pembayaran</h2>
                </div>
            </div>
            <div class="table_section padding_infor_info ">
                <div class="table-responsive-sm">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Metode</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembayarans as $pembayaran)
                            <tr>
                                <td class="text-center">{{$loop->index+1}}</td>
                                <td>{{$pembayaran->user->username}}</td>
                                <td>@currency($pembayaran->jumlah)</td>
                                <td>{{$pembayaran->metode}}</td>
                                <td>{{$pembayaran->status}}</td>
                                <td class="text-center">
                                    <a href="{{route('admin-read-pembayaran', ['id' => $iuran_id, 'pembayaran_id' => $pembayaran->id])}}"><button type="button" class="btn btn-primary"><i class="fa fa-book text-white"></i></button></a>
                                    @if(!($pembayaran->status == "Terverifikasi" || $pembayaran->status == "Dibatalkan"))
                                    <a href="{{route('admin-view-konfirmasi-pembayaran', ['id' => $iuran_id, 'pembayaran_id' => $pembayaran->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-check text-white"></i></button></a>
                                    @endif
                                </td>
                            </tr>
                            <div class="modal fade" id="delete-modal{{$loop->index+1}}">
                                <form method="post" action="{{route('admin-delete-pembayaran', ['id' => $iuran_id, 'pembayaran_id' => $pembayaran->id])}}">
                                    @csrf
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Konfirmasi</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus pembayaran {{$pembayaran->user->username}}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Ya</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection