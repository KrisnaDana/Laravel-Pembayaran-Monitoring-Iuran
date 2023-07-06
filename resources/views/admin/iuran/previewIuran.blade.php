@extends('layout.pluto')

@section('page_title','Iuran')

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
        <li class="breadcrumb-item"><u class="blue1_color"><a class="blue1_color" href="{{route('admin-view-iuran')}}">Iuran</a></u></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Iuran</li>
    </ol>
</nav>
<div class="row column3 graph">
    <div class="col-md-6 col-lg-6">
        <div class="white_shd full">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                <h2>Edit Data Iuran</h2>
                </div>
            </div>
            
                <div class="table_section padding_infor_info ">
                    <div class="mb-3">
                        <label class="form-label" for="nama">Nama :</label>
                        <input autocomplete="off" type="text" class="form-control" name="nama" id="nama" spellcheck="disabled" value="{{$iuran->nama}}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="deskripsi">Deskripsi :</label>
                        <input autocomplete="off" type="text" class="form-control" name="deskripsi" id="deskripsi" spellcheck="disabled" value="{{$iuran->deskripsi}}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tujuan_transfer">Tujuan Transfer : (Contoh : DANA 12345678)</label>
                        <input autocomplete="off" type="text" class="form-control" name="tujuan_transfer" id="tujuan_transfer" spellcheck="disabled" value="{{$iuran->tujuan_transfer}}" disabled>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="status">Status :</label>
                            <select class="form-control" name="status" id="status" aria-label="Default select example" disabled>
                                <option selected>{{$iuran->status}}</option>
                                <option @if ($iuran->status == 'Buka') selected="selected" @endif value="Buka">Buka</option>
                                <option @if ($iuran->status == 'Tutup') selected="selected" @endif value="Tutup">Tutup</option>
                            </select>
                        </div>
                        <div class="col">
                            <div class="">
                                <label class="form-label" for="jumlah">Jumlah (Rp.) :</label>
                                <input autocomplete="off" type="text" class="form-control" name="jumlah" id="jumlah" spellcheck="disabled" value="{{$iuran->jumlah}}" disabled>
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
        <div class="white_shd full">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                <h2>Gambar Iuran</h2>
                </div>
            </div>
            <div class="" style="text-align:center">

                <a data-fancybox="gallery"><img class="img-responsive" src="{{url('gambar/iuran/'.$iuran->gambar)}}" alt="#" style="width: 50%;"></a>
            </div>

        </div>
    </div>
</div>


@endsection