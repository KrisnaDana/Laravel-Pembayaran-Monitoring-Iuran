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

<div class="row column3 graph">
    <div class="col-md-6 col-lg-6">
        <div class="white_shd full">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                <h2>Tambah Data Iuran</h2>
                </div>
            </div>
            <div class="table_section padding_infor_info ">
                <form method="POST" action="{{ route('admin-store-iuran') }}" id="formCreate" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="nama">Nama :</label>
                        <input autocomplete="off" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" spellcheck="disabled" value="{{old('nama')}}">
                        @error ('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="deskripsi">Deskripsi :</label>
                        <input autocomplete="off" type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" spellcheck="disabled" value="{{old('deskripsi')}}">
                        @error ('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tujuan_transfer">Tujuan Transfer : (Contoh : DANA 12345678)</label>
                        <input autocomplete="off" type="text" class="form-control @error('tujuan_transfer') is-invalid @enderror" name="tujuan_transfer" id="tujuan_transfer" spellcheck="disabled" value="{{old('tujuan_transfer')}}">
                        @error ('tujuan_transfer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="status">Status :</label>
                            <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" aria-label="Default select example" >
                                <option value="">Pilih Status</option>
                                <option value="Buka">Buka</option>
                                <option value="Tutup">Tutup</option>
                            </select>
                            @error ('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label" for="jenis">Jenis :</label>
                            <select class="form-control @error('status') is-invalid @enderror" name="jenis" id="jenis" aria-label="Default select example" >
                                <option value="">Pilih Jenis</option>
                                <option value="Sekali">Sekali</option>
                                <option value="Periodik">Periodik</option>
                            </select>
                            @error ('jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="jumlah">Jumlah (Rp.) :</label>
                                <input autocomplete="off" type="text" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" id="jumlah" spellcheck="disabled" value="">
                                @error ('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="jarak_periode">Jarak Periode (Hari) :</label>
                                <input autocomplete="off" type="number" class="form-control @error('jarak_periode') is-invalid @enderror" name="jarak_periode" id="jarak_periode" spellcheck="disabled" value="">
                                @error ('jarak_periode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="mulai">Tanggal Mulai :</label>
                                <input autocomplete="off" type="date" class="form-control @error('mulai') is-invalid @enderror" name="mulai" id="mulai" spellcheck="disabled" value="">
                                @error ('mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="akhir">Tanggal Berakhir :</label>
                                <input autocomplete="off" type="date" class="form-control @error('akhir') is-invalid @enderror" name="akhir" id="akhir" spellcheck="disabled" value="">
                                @error ('akhir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="gambar">Gambar :</label>
                        <input type="file" class="form-control" required accept=" @error('gambar') is-invalid @enderror" name="gambar[]" id="gambar" multiple>
                        @if ($errors->has('gambar'))
                            <div class="invalid-feedback">{{ $errors->first('gambar') }}</div>
                        @endif
                    </div>
                    <div class="mt-4">
                        <div class="button_block">
                            <button type="submit" class="btn cur-p btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection