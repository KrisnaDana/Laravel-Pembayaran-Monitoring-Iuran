@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>Perbaikan Pembayaran</h2>
        </div>
    </div>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" class="bg-transparent" style="background-color:transparent;">
        <li class="breadcrumb-item"><u class="blue1_color"><a class="blue1_color" href="{{route('index-pembayaran')}}">Pembayaran</a></u></li>
        <li class="breadcrumb-item active" aria-current="page">Perbaikan Pembayaran</li>
    </ol>
</nav>
<div class="row column3 graph">
    <div class="col-md-12 col-lg-12">
        <div class="white_shd full">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                <h2>Perbaikan Pembayaran</h2>
                </div>
            </div>
            <div class="table_section padding_infor_info ">
                <form method="POST" action="{{route('edit-pembayaran', ['id' => $pembayaran->id])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Metode :</label>
                        <input autocomplete="off" type="text" class="form-control" spellcheck="disabled" value="{{$pembayaran->metode}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal :</label>
                        <input autocomplete="off" type="date" class="form-control" spellcheck="disabled" value="{{Carbon\Carbon::parse($pembayaran->created_at)->format('Y-m-d')}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status :</label>
                        <input autocomplete="off" type="text" class="form-control" spellcheck="disabled" value="{{$pembayaran->status}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catatan Pembayaran :</label>
                        <textarea class="form-control" spellcheck="disabled" name="catatan" rows="3" readonly>{{$pembayaran->catatan}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah (Rp.):</label>
                        <input autocomplete="off" type="text" class="form-control" spellcheck="disabled" value="{{$pembayaran->jumlah}}" name="jumlah">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="jumlah">Bukti Pembayaran :</label>
                        <input type="file" class="form-control @error('bukti_pembayaran') is-invalid @enderror" required name="bukti_pembayaran">
                        @error('bukti_pembayaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button style="width:100%;" type="submit" class="model_bt btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection