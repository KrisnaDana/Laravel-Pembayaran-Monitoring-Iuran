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
    <div class="col-md-6 col-lg-3">
        <div class="full counter_section margin_bottom_30 yellow_bg">
            <div class="couter_icon">
                <div> 
                <i class="fa fa-user"></i>
                </div>
            </div>
            <div class="counter_no">
                <div>
                <p class="total_no">2500</p>
                <p class="head_couter">Welcome</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="full counter_section margin_bottom_30 blue1_bg">
            <div class="couter_icon">
                <div> 
                <i class="fa fa-clock-o"></i>
                </div>
            </div>
            <div class="counter_no">
                <div>
                <p class="total_no">123.50</p>
                <p class="head_couter">Average Time</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="full counter_section margin_bottom_30 green_bg">
            <div class="couter_icon">
                <div> 
                <i class="fa fa-cloud-download"></i>
                </div>
            </div>
            <div class="counter_no">
                <div>
                <p class="total_no">1,805</p>
                <p class="head_couter">Collections</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="full counter_section margin_bottom_30 red_bg">
            <div class="couter_icon">
                <div> 
                <i class="fa fa-comments-o"></i>
                </div>
            </div>
            <div class="counter_no">
                <div>
                <p class="total_no">54</p>
                <p class="head_couter">Comments</p>
                </div>
            </div>
        </div>
    </div>
</div>
         
<div class="row column2 graph margin_bottom_30">
    <div class="col-md-12 col-lg-12">
        <div class="button_block">
            <button type="button" class="btn cur-p btn-primary">
                <i class="fa fa-plus">&nbsp;</i>Tambah Data Iuran
            </button>
        </div>
    </div>
</div>

<div class="row column3 graph margin_bottom_30">
    <div class="col-md-l2 col-lg-12">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                <h2>Tabel Data Iuran</h2>
                </div>
            </div>
            <div class="table_section padding_infor_info ">
                <div class="table-responsive-sm">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Tujuan Transfer</th>
                            <th>Jumlah</th>
                            <th>Terkumpul</th>
                            <th>Tersisa</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($iurans as $iuran)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$iuran->nama}}</td>
                            <td>{{$iuran->deskripsi}}</td>
                            <td>{{$iuran->tujuan_transfer}}</td>
                            <td>{{$iuran->jumlah}}</td>
                            <td>{{$iuran->terkumpul}}</td>
                            <td>{{$iuran->tersisa}}</td>
                            <td>{{$iuran->status}}</td>
                            <td>Action</td>
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