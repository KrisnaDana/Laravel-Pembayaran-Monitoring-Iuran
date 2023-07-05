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
        <li class="breadcrumb-item active" aria-current="page">Ubah Periode</li>
    </ol>
</nav>
<div class="row column3 graph">
    <div class="col-md-12 col-lg-12">
        <div class="white_shd full">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                <h2>Ubah Data Periode</h2>
                </div>
            </div>
            <div class="table_section padding_infor_info ">
                <form method="POST" action="{{route('admin-edit-periode', ['id' => $iuran_id, 'periode_id' => $periode->id])}}">
                    @csrf
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="mulai">Tanggal Mulai :</label>
                            <input autocomplete="off" type="date" class="form-control @error('mulai') is-invalid @enderror" name="mulai" id="mulai" spellcheck="disabled" value="{{old('mulai') ? old('mulai') : $periode->mulai}}">
                            @error ('mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Berakhir :</label>
                            <input autocomplete="off" type="date" class="form-control @error('berakhir') is-invalid @enderror" name="berakhir" id="berakhir" spellcheck="disabled" value="{{old('berakhir') ? old('berakhir') : $periode->akhir}}">
                            @error ('berakhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button style="width:100%;" type="submit" class="model_bt btn btn-primary mt-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection