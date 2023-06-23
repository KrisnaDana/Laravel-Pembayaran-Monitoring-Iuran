@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>Alokasi</h2>
        </div>
    </div>
</div>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb" class="bg-transparent" style="background-color:transparent;">
        <li class="breadcrumb-item">Pilih Iuran</li>
    </ol>
</nav>

<div class="row column3 graph margin_bottom_30">
    <div class="col-md-l2 col-lg-12">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                <h2>Pilih Data Iuran</h2>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($iurans as $iuran)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$iuran->nama}}</td>
                            <td>{{$iuran->deskripsi}}</td>
                            <td>
                                <a href="{{ route('admin-view-alokasi', ['id' => $iuran->id]) }}" class="btn btn-success">Pilih</a>
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