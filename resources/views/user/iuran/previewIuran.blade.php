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
                            <label class="form-label" for="jumlah">Jumlah (Rp.) :</label>
                            <input autocomplete="off" type="text" class="form-control" name="jumlah" id="jumlah" spellcheck="disabled" value="Rp. {{$iuran->jumlah}}" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="status">Terkumpul :</label>
                            <input autocomplete="off" type="text" class="form-control" name="status" id="status" spellcheck="disabled" value="Rp. {{$iuran->terkumpul}}" disabled>
                        </div>
                        <div class="col">
                            <label class="form-label" for="jumlah">Tersisa :</label>
                            <input autocomplete="off" type="text" class="form-control"  spellcheck="disabled" value="Rp. {{$iuran->tersisa}}" disabled>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="button_block">
                            <a href="{{route('user-view-iuran')}}" type="button" class="btn cur-p btn-primary">Back</a>
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
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered  " role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Detail Alokasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <img class="img-responsive" src="{{url('alokasi_foto/'.$alokasi->foto)}}" alt="#" style="width: 50%;">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nama</label>
                                                <input type="text" class="form-control @error('alokasi_name') is-invalid @enderror" name="alokasi_name" value="{{$alokasi->nama}}" spellcheck="disabled" disabled readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Deskripsi</label>
                                                <textarea type="text" class="form-control @error('alokasi_deskripsi') is-invalid @enderror" name="alokasi_deskripsi" rows="4" spellcheck="disabled" disabled readonly>{{$alokasi->deskripsi}}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah (Rp.)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp.</span>
                                                    <input type="number" class="form-control @error('alokasi_jumlah') is-invalid @enderror" name="alokasi_jumlah" value="{{$alokasi->jumlah}}" spellcheck="disabled" disabled readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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