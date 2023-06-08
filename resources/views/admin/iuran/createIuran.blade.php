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
                        <input autocomplete="off" type="text" class="form-control" name="nama" id="nama" spellcheck="disabled" value="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="deskripsi">Deskripsi :</label>
                        <input autocomplete="off" type="text" class="form-control" name="deskripsi" id="deskripsi" spellcheck="disabled" value="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tujuan_transfer">Tujuan Transfer : (Contoh : DANA 12345678)</label>
                        <input autocomplete="off" type="text" class="form-control" name="tujuan_transfer" id="tujuan_transfer" spellcheck="disabled" value="">
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="status">Status :</label>
                            <select class="form-control" name="status" id="status" aria-label="Default select example" >
                                <option>Pilih Status</option>
                                <option value="Buka">Buka</option>
                                <option value="Tutup">Tutup</option>
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label" for="jenis">Jenis :</label>
                            <select class="form-control" name="jenis" id="jenis" aria-label="Default select example" >
                                <option>Pilih Jenis</option>
                                <option value="Sekali">Sekali</option>
                                <option value="Periodik">Periodik</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="jumlah">Jumlah (Rp.) :</label>
                                <input autocomplete="off" type="text" class="form-control" name="jumlah" id="jumlah" spellcheck="disabled" value="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="jarak_periode">Jarak Periode (Hari) :</label>
                                <input autocomplete="off" type="number" class="form-control" name="jarak_periode" id="jarak_periode" spellcheck="disabled" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="mulai">Tanggal Mulai :</label>
                                <input autocomplete="off" type="date" class="form-control" name="mulai" id="mulai" spellcheck="disabled" value="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="akhir">Tanggal Berakhir :</label>
                                <input autocomplete="off" type="date" class="form-control" name="akhir" id="akhir" spellcheck="disabled" value="">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="gambar">Gambar :</label>
                        <input type="file" class="form-control" name="gambar[]" id="gambar" multiple>
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