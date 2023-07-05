@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>Periode</h2>
        </div>
    </div>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" class="bg-transparent" style="background-color:transparent;">
        <li class="breadcrumb-item"><u class="blue1_color"><a class="blue1_color" href="{{route('admin-view-periode-pilih-iuran')}}">Pilih Iuran</a></u></li>
        <li class="breadcrumb-item"><u class="blue1_color"><a class="blue1_color" href="{{route('admin-view-periode', ['id' => $iuran_id])}}">List Periode</a></u></li>
        <li class="breadcrumb-item active" aria-current="page">Lihat Periode</li>
    </ol>
</nav>
<div class="row column3 graph">
    <div class="col-md-12 col-lg-12">
        <div class="white_shd full">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                <h2>Lihat Data Periode</h2>
                </div>
            </div>
            <div class="table_section padding_infor_info ">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="mulai">Tanggal Mulai :</label>
                            <input autocomplete="off" type="date" class="form-control" name="mulai" id="mulai" spellcheck="disabled" value="{{$periode->mulai}}" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Berakhir :</label>
                            <input autocomplete="off" type="date" class="form-control" name="berakhir" id="berakhir" spellcheck="disabled" value="{{$periode->akhir}}" readonly>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="form-label" for="mulai">Total :</label>
                    <input autocomplete="off" type="text" class="form-control" name="mulai" id="mulai" spellcheck="disabled" value="@currency($periode->jumlah)" readonly>
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
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($periode_bayars as $periode_bayar)
                            <tr>
                                <td class="text-center">{{$loop->index+1}}</td>
                                <td>{{$periode_bayar->user->username}}</td>
                                <td>@currency($periode_bayar->jumlah)</td>
                                <td class="text-center">{{$periode_bayar->status}}</td>
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