@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>Iuran</h2>
        </div>
    </div>
</div>

<div class="row column1">
    <div class="col-md-12">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>Pilih Iuran</h2>
                </div>
            </div>
            <div class="full price_table padding_infor_info">
                <div class="row">

                    @foreach($iurans as $iuran)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="table_price full">
                            <div class="inner_table_price">
                                <div class="price_table_head red_bg">
                                    <h2>{{$iuran->nama}}</h2>
                                </div>
                                <div class="price_table_inner">
                                    <div class="cont_table_price_blog">
                                        <p class="red_color">Rp. <span class="price_no">{{$iuran->jumlah}}</span> </p>
                                    </div>
                                    <div class="cont_table_price">
                                        <ul>
                                            <li><a href="#">Status : {{$iuran->status}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="price_table_bottom">
                                    <div class="row">
                                        <div class="col">
                                            <div class="center"><a class="main_bt bg-primary" href="{{route('user-preview-iuran', ['id' => $iuran->id])}}"><i class="fa fa-eye"></i>  Lihat</a></div>
                                        </div>
                                        @if($iuran->status == "Buka")
                                        <div class="col">
                                            <div class="center"><a class="main_bt btn-success" href="{{route('user-bayar-iuran', ['id' => $iuran->id])}}">Bayar</a></div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

@endsection