@extends('layout.pluto')

@section('page_title','Iuran')

@section('content')


<div class="row column3 graph">
    <div class="col-md-6 col-lg-6">
        <div class="white_shd full">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                <h2>Tambah Data Iuran</h2>
                </div>
            </div>
            <div class="table_section padding_infor_info ">
                <div class="mb-3">
                    <label class="form-label">Nama :</label>
                    <input type="text" class="form-control" spellcheck="disabled" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi :</label>
                    <input type="text" class="form-control" spellcheck="disabled" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tujuan Transfer :</label>
                    <input type="text" class="form-control" spellcheck="disabled" value="">
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Status :</label>
                        <select class="form-control" id="pura_id" name="pura_id" aria-label="Default select example" >
                            <option >Pilih Status</option>
                            <option value="Buka">Pilih Pura</option>
                            <option value="Tutup">Pilih Pura</option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label">Jenis :</label>
                        <select class="form-control" id="pura_id" name="pura_id" aria-label="Default select example" >
                            <option>Pilih Jenis</option>
                            <option value="Sekali">Pilih Pura</option>
                            <option value="Periodik">Pilih Pura</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Jumlah :</label>
                            <input type="text" class="form-control" spellcheck="disabled" value="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Jarak Periode (Hari) :</label>
                            <input type="text" class="form-control" spellcheck="disabled" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Mulai :</label>
                            <input type="date" class="form-control" spellcheck="disabled" value="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Berakhir :</label>
                            <input type="date" class="form-control" spellcheck="disabled" value="">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar :</label>
                    <input type="file" class="form-control" spellcheck="disabled" value="">
                </div>
                <div class="mt-4">
                    <div class="button_block">
                        <button type="button" class="btn cur-p btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection