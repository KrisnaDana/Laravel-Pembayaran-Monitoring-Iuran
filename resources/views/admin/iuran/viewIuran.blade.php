@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Iuran</h2>
                </div>
                <div class="col">
                    <a href="{{ route('admin-create-iuran') }}"><button type="button" class="btn cur-p btn-lg btn-primary" style="float: right;">Tambah</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb" class="bg-transparent" style="background-color:transparent;">
        <li class="breadcrumb-item"><u class="blue1_color"><a class="blue1_color" href="{{route('admin-view-iuran')}}">Iuran</a></u></li>
        <li class="breadcrumb-item active" aria-current="page">List Iuran</li>
    </ol>
</nav>         


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
                        <thead class="thead-light">
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
                                <td>@currency($iuran->jumlah)</td>
                                <td>@currency($iuran->terkumpul)</td>
                                <td>@currency($iuran->tersisa)</td>
                                <td>{{$iuran->status}}</td>
                                <td style="width:12%">
                                    <div class="">
                                        <a href="/admin/edit-iuran-{{$iuran->id}}" class="btn btn-warning">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="/admin/preview-iuran-{{$iuran->id}}" class="btn btn-success">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="/admin/delete-iuran-{{$iuran->id}}" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
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