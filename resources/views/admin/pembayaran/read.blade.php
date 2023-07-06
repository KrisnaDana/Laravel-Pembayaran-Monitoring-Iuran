@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>Pembayaran</h2>
        </div>
    </div>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" class="bg-transparent" style="background-color:transparent;">
        <li class="breadcrumb-item"><u class="blue1_color"><a class="blue1_color" href="{{route('admin-view-pembayaran-pilih-iuran')}}">Pilih Iuran</a></u></li>
        <li class="breadcrumb-item"><u class="blue1_color"><a class="blue1_color" href="{{route('admin-view-pembayaran', ['id' => $iuran_id])}}">List Pembayaran</a></u></li>
        <li class="breadcrumb-item active" aria-current="page">Lihat Pembayaran</li>
    </ol>
</nav>
<div class="row column3 graph">
    <div class="col-md-12 col-lg-12">
        <div class="white_shd full">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                <h2>Lihat Pembayaran</h2>
                </div>
            </div>
            <div class="table_section padding_infor_info ">
                <div class="mb-3">
                    <label class="form-label">Username :</label>
                    <input autocomplete="off" type="text" class="form-control" spellcheck="disabled" value="{{$pembayaran->user->username}}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama :</label>
                    <input autocomplete="off" type="text" class="form-control" spellcheck="disabled" value="{{$pembayaran->user->nama}}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat :</label>
                    <input autocomplete="off" type="text" class="form-control" spellcheck="disabled" value="{{$pembayaran->user->alamat}}" readonly>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Jumlah :</label>
                            <input autocomplete="off" type="text" class="form-control" spellcheck="disabled" value="@currency($pembayaran->jumlah)" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Metode :</label>
                            <input autocomplete="off" type="text" class="form-control" name="berakhir" id="berakhir" spellcheck="disabled" value="{{$pembayaran->metode}}" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Tanggal :</label>
                            <input autocomplete="off" type="date" class="form-control" name="berakhir" id="berakhir" spellcheck="disabled" value="{{Carbon\Carbon::parse($pembayaran->created_at)->format('Y-m-d')}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status :</label>
                    <input autocomplete="off" type="text" class="form-control" spellcheck="disabled" value="{{$pembayaran->status}}" readonly>
                </div>
                @if(!empty($pembayaran->bukti_transfer))
                <div class="mb-3">
                    <label class="form-label">Bukti Transfer :</label>
                    <br>
                    <img src="{{ url('bukti-transfer-user/'.$pembayaran->bukti_transfer) }}" width="500px"></img>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection