@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Detail Akun Admin</h2>
                </div>
                <div class="col">
                    <a href="{{ route('admin-master-view-list-admin') }}"><button type="button" class="btn cur-p btn-lg btn-danger" style="float: right;">Kembali</button></a>
                    <a href=""><button type="button" class="btn cur-p btn-lg btn-primary mr-3" style="float: right;"><i class="fa fa-refresh"></i></button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30">
            <div class="table_section padding_infor_info">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama_admin') is-invalid @enderror" name="nama_admin" placeholder="Masukkan nama admin" value="{{$admin->nama}}" spellcheck="disabled" disabled>
                    @error('nama_admin')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control @error('username_admin') is-invalid @enderror" name="username_admin" placeholder="Masukkan username" value="{{$admin->username}}" spellcheck="disabled" disabled>
                    @error('username_admin')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <!-- <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" class="form-control @error('password_admin') is-invalid @enderror" name="password_admin" placeholder="Masukkan password jika ingin diubah" value="{{$admin->password}}" spellcheck="disabled" disabled>
                    @error('password_admin')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div> -->
            </div>
        </div>
    </div>
</div>
@endsection