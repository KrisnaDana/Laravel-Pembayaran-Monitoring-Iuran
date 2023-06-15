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
        <div class="white_shd full">
            <div class="table_section padding_infor_info">
                <form method="post" action="{{ route('admin-update-alokasi', ['iuranId' => $iurans->id, 'alokasiId' => $alokasis->id]) }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label @error('alokasi_name') is-invalid @enderror">Nama</label>
                        <input type="text" class="form-control" name="alokasi_name" value="{{ $alokasis->nama }}" spellcheck="disabled">
                        @error('alokasi_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <div class="mb-3">
                        <label class="form-label @error('alokasi_deskripsi') is-invalid @enderror">Deskripsi</label>
                        <textarea type="text" class="form-control" name="alokasi_deskripsi" rows="4" spellcheck="disabled">{{ $alokasis->deskripsi }}</textarea>
                        @error('alokasi_deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <div class="mb-3">
                        <label class="form-label @error('alokasi_jumlah') is-invalid @enderror">Jumlah (Rp.)</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input type="number" class="form-control" name="alokasi_jumlah" value="{{ $alokasis->jumlah }}" spellcheck="disabled">
                            @error('alokasi_jumlah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
    
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Foto</label>
                        <input class="form-control @error('alokasi_foto') is-invalid @enderror" type="file" id="alokasi_foto" accept="image/*" name="alokasi_foto" value="{{ old('alokasi_foto') }}">
                        @error('alokasi_foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button style="width:100%;" type="submit" class="model_bt btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col">
        @if($alokasis->foto)
            <div class="white_shd full margin_bottom_30 shadow" style="width: 600px; height: 450px;">
                <img src="{{ asset('alokasi_foto/' . $alokasis->foto) }}" alt="Alokasi Picture" class="img-fluid">
            </div>
        @else
            <div class="white_shd full">
                <div class="table_section padding_infor_info">
                    <p class="text-center">Foto tidak tersedia</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection