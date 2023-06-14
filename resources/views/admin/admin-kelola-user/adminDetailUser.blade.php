@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Detail Akun User</h2>
                </div>
                <div class="col">
                    <a href="{{ route('admin-view-list-user') }}"><button type="button" class="btn cur-p btn-lg btn-danger" style="float: right;">Kembali</button></a>
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
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control @error('username_user') is-invalid @enderror" name="username_user" value="{{$user->username}}" placeholder="Masukkan username" spellcheck="disabled" required readonly>
                            @error('username_user')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control @error('password_user') is-invalid @enderror" name="password_user" value="{{$user->password}}" placeholder="Masukkan password" spellcheck="disabled" required readonly>
                            @error('password_user')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama_user') is-invalid @enderror" name="nama_user" value="{{$user->nama}}" placeholder="Masukkan nama admin" spellcheck="disabled" required readonly>
                    @error('nama_user')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Telepon</label>
                    <input type="number" class="form-control @error('telepon_user') is-invalid @enderror" name="telepon_user" value="{{$user->telepon}}" placeholder="Masukkan nomor telepon" spellcheck="disabled" required readonly>
                    @error('telepon_user')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control @error('alamat_user') is-invalid @enderror" name="alamat_user" placeholder="Masukkan alamat" rows="3" spellcheck="disabled" required readonly>{{$user->alamat}}</textarea>
                    @error('alamat_user')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Verifikasi</label>
                            <input class="form-control" value="{{$user->verifikasi}}" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <input class="form-control" value="{{$user->status}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Catatan Verifikasi</label>
                    <textarea class="form-control @error('catatan_verifikasi_user') is-invalid @enderror" name="catatan_verifikasi_user" placeholder="Masukkan catatan verifikasi" rows="3" spellcheck="disabled" required readonly>{{$user->catatan_verifikasi}}</textarea>
                    @error('catatan_verifikasi_user')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mt-2 mb-3">
                    <span class="text-center">Foto KTP</span>
                    <div class="position-relative">
                        <img src="{{url('images/verifikasi-users/'.$user->file_verifikasi)}}" class="rounded d-block" alt="..." style="width: 500px; max-height: 500px; margin-top: 10px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection