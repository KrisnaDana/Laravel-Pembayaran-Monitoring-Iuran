@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>Alokasi Berdasarkan Iuran {{ $iurans->nama }}</h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full mt-5">
            <div class="table_section padding_infor_info">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="alokasi_name" value="{{ $alokasis->nama }}" spellcheck="disabled" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea type="text" class="form-control" name="alokasi_deskripsi" rows="4" spellcheck="disabled" readonly>{{ $alokasis->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah (Rp.)</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="number" class="form-control" name="alokasi_jumlah" value="{{ $alokasis->jumlah }}" spellcheck="disabled" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="white_shd full margin_bottom_30 shadow" style="width: 600px; height: 450px;">
            <img src="{{ asset('alokasi_foto/' . $alokasis->foto) }}" alt="Alokasi Picture" class="img-fluid">
        </div>
    </div>
</div>


@endsection