@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <div class="py-2">
                <h2>Periode</h2>
            </div>
        </div>
    </div>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" class="bg-transparent" style="background-color:transparent;">
        <li class="breadcrumb-item active" aria-current="page">Pilih Iuran</li>
    </ol>
</nav>
<div class="row column3 graph margin_bottom_30">
    <div class="col-md-l2 col-lg-12">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                <h2>Pilih Iuran</h2>
                </div>
            </div>
            <div class="table_section padding_infor_info ">
                <div class="table-responsive-sm">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Nama Iuran</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($iurans as $iuran)
                            <tr>
                                <td class="text-center">{{$loop->index+1}}</td>
                                <td>{{$iuran->nama}}</td>
                                <td class="text-center">
                                    <a href="{{route('admin-view-periode', ['id' => $iuran->id])}}"><button type="button" class="btn btn-success">Pilih</button></a>
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