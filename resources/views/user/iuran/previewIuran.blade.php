@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>Iuran</h2>
        </div>
    </div>
</div>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb" class="bg-transparent" style="background-color:transparent;">
        <li class="breadcrumb-item"><u class="blue1_color"><a class="blue1_color" href="{{route('user-view-iuran')}}">Iuran</a></u></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Iuran</li>
    </ol>
</nav>   

<div class="row column1">
    <div class="col-md-6 col-lg-6">
        <div class="white_shd full margin_bottom_30">
        <div class="full graph_head">
                <div class="heading1 margin_0">
                <h2>Detail Iuran</h2>
                </div>
            </div>
            
                <div class="table_section padding_infor_info ">
                    <div class="mb-3" style="text-align:center">
                        <img class="img-responsive" src="{{url('gambar/iuran/'.$iuran->gambar)}}" alt="#" style="width: 50%;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="nama">Nama :</label>
                        <input autocomplete="off" type="text" class="form-control" name="nama" id="nama" spellcheck="disabled" value="{{$iuran->nama}}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="deskripsi">Deskripsi :</label>
                        <input autocomplete="off" type="text" class="form-control" name="deskripsi" id="deskripsi" spellcheck="disabled" value="{{$iuran->deskripsi}}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tujuan_transfer">Tujuan Transfer : </label>
                        <input autocomplete="off" type="text" class="form-control" name="tujuan_transfer" id="tujuan_transfer" spellcheck="disabled" value="{{$iuran->tujuan_transfer}}" disabled>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="status">Status :</label>
                            <input autocomplete="off" type="text" class="form-control" name="status" id="status" spellcheck="disabled" value="{{$iuran->status}}" disabled>
                        </div>
                        <div class="col">
                            <label class="form-label" for="jenis">Jenis :</label>
                            <input autocomplete="off" type="text" class="form-control" name="jenis" id="jenis" spellcheck="disabled" value="{{$iuran->jenis}}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="jumlah">Jumlah (Rp.) :</label>
                                <input autocomplete="off" type="text" class="form-control" name="jumlah" id="jumlah" spellcheck="disabled" value="{{$iuran->jumlah}}" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="jarak_periode">Jarak Periode (Hari) :</label>
                                <input autocomplete="off" type="number" class="form-control" name="jarak_periode" id="jarak_periode" spellcheck="disabled" value="{{$iuran->jarak_periode}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="mulai">Tanggal Mulai :</label>
                                <input autocomplete="off" type="date" class="form-control" name="mulai" id="mulai" spellcheck="disabled" value="{{$iuran->mulai}}" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="akhir">Tanggal Berakhir :</label>
                                <input autocomplete="off" type="date" class="form-control" name="akhir" id="akhir" spellcheck="disabled" value="{{$iuran->akhir}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="button_block">
                            <a href="{{route('admin-view-iuran')}}" type="button" class="btn cur-p btn-primary">Back</a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                <h2>Alokasi Iuran</h2>
                </div>
            </div>
            
            <div class="table_section padding_infor_info ">
                <div class="table-responsive-sm">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alokasis as $alokasi)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$alokasi->nama}}</td>
                                <td>@currency($alokasi->jumlah)</td>
                                <td style="width:10%">
                                    <div class="">
                                        <a href="/admin/preview-alokasi-{{$alokasi->id}}" class="btn btn-success">
                                            <i class="fa fa-eye"></i>
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
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                <h2>Periode Iuran</h2>
                </div>
            </div>
            
            <div class="table_section padding_infor_info ">
                <div class="table-responsive-sm">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Periode Ke</th>
                                <th>Tgl. Mulai</th>
                                <th>Tgl. Akhir</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($periodebayar as $periode)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$periode->periode_ke}}</td>
                                <td>{{$periode->mulai}}</td>
                                <td>{{$periode->akhir}}</td>
                                <td>@currency($periode->jumlah)</td>
                                <td style="width:10%">
                                    @if($periode->status === null)
                                        Belum Lunas
                                    @endif
                                    {{$periode->status}}
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