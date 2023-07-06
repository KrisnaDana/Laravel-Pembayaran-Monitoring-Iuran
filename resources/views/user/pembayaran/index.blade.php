@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <div class="row">
                <div class="col my-2">
                    <h2>Pembayaran</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" class="bg-transparent" style="background-color:transparent;">
        <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
    </ol>
</nav>
<div class="row column3 graph margin_bottom_30">
    <div class="col-md-l2 col-lg-12">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                <h2>Pembayaran</h2>
                </div>
            </div>
            <div class="table_section padding_infor_info ">
                <div class="table-responsive-sm">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
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
                                <td>@currency($pembayaran->jumlah)</td>
                                <td>{{$pembayaran->metode}}</td>
                                <td>{{$pembayaran->status}}</td>
                                <td class="text-center">
                                    <a href="{{route('read-pembayaran', ['id' => $pembayaran->id])}}"><button type="button" class="btn btn-primary"><i class="fa fa-book text-white"></i></button></a>
                                    @if($pembayaran->status == "Perbaikan pembayaran")
                                    <a href="{{route('edit-pembayaran', ['id' => $pembayaran->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-check text-white"></i></button></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection