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
        <li class="breadcrumb-item active" aria-current="page">Edit Iuran</li>
    </ol>
</nav>
<div class="row column3 graph">
    <div class="col-md-12 col-lg-12">
        <div class="white_shd full">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                <h2>Edit Data Iuran</h2>
                </div>
            </div>
            <div class="table_section padding_infor_info ">
                <form method="POST" action="/admin/update-iuran-{{$iuran->id}}" id="formCreate" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="nama">Nama :</label>
                        <input autocomplete="off" type="text" class="form-control" name="nama" id="nama" spellcheck="disabled" value="{{$iuran->nama}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="deskripsi">Deskripsi :</label>
                        <input autocomplete="off" type="text" class="form-control" name="deskripsi" id="deskripsi" spellcheck="disabled" value="{{$iuran->deskripsi}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tujuan_transfer">Tujuan Transfer : (Contoh : DANA 12345678)</label>
                        <input autocomplete="off" type="text" class="form-control" name="tujuan_transfer" id="tujuan_transfer" spellcheck="disabled" value="{{$iuran->tujuan_transfer}}">
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="status">Status :</label>
                            <select class="form-control" name="status" id="status" aria-label="Default select example" >
                                <option selected>Pilih Status</option>
                                <option @if ($iuran->status == 'Buka') selected="selected" @endif value="Buka">Buka</option>
                                <option @if ($iuran->status == 'Tutup') selected="selected" @endif value="Tutup">Tutup</option>
                            </select>
                        </div>
                        <div class="col">
                            <div class="">
                                <label class="form-label" for="jumlah">Jumlah (Rp.) :</label>
                                <input autocomplete="off" type="text" class="form-control" name="jumlah" id="jumlah" spellcheck="disabled" value="{{$iuran->jumlah}}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="gambar">Gambar :</label>
                        <input type="file" class="form-control" name="gambar[]" id="gambar" multiple>
                    </div>
                    <div class="mt-4">
                        <div class="button_block">
                            <button type="submit" class="btn cur-p btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection