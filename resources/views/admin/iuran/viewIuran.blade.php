@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>Iuran</h2>
        </div>
    </div>
</div>
         
<div class="row column2 graph margin_bottom_30">
    <div class="col-md-12 col-lg-12">
        <div class="button_block">
            <a href="{{ route('admin-create-iuran') }}" type="button" class="btn cur-p btn-primary">
                <i class="fa fa-plus">&nbsp;</i>Tambah Data Iuran
            </a>
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
                                <td style="width:10%">
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