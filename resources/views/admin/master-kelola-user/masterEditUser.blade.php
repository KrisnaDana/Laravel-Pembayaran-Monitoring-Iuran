@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Edit Akun User</h2>
                </div>
                <div class="col">
                    <a href="{{ route('admin-master-view-list-user') }}"><button type="button" class="btn cur-p btn-lg btn-danger" style="float: right;">Kembali</button></a>
                    <a href=""><button type="button" class="btn cur-p btn-lg btn-primary mr-3" style="float: right;"><i class="fa fa-refresh"></i></button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30">
            <form id="editSubmit" method="post" action="{{ route('admin-master-edit-user-submit', $user->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="table_section padding_infor_info">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control @error('username_user') is-invalid @enderror" name="username_user" value="{{$user->username}}" placeholder="Masukkan username" spellcheck="disabled" required>
                                @error('username_user')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control @error('password_user') is-invalid @enderror" name="password_user" value="{{$user->password}}" placeholder="Masukkan password" spellcheck="disabled" required>
                                @error('password_user')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama_user') is-invalid @enderror" name="nama_user" value="{{$user->nama}}" placeholder="Masukkan nama admin" spellcheck="disabled" required>
                        @error('nama_user')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="number" class="form-control @error('telepon_user') is-invalid @enderror" name="telepon_user" value="{{$user->telepon}}" placeholder="Masukkan nomor telepon" spellcheck="disabled" required>
                        @error('telepon_user')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat_user') is-invalid @enderror" name="alamat_user" placeholder="Masukkan alamat" rows="3" spellcheck="disabled" required>{{$user->alamat}}</textarea>
                        @error('alamat_user')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Verifikasi</label>
                                <select class="form-control @error('verifikasi_user') is-invalid @enderror" name="verifikasi_user">
                                    <option value="{{$user->verifikasi}}" selected disabled>{{$user->verifikasi}}</option>
                                    <option value="Belum terverifikasi">Belum Terverifikasi</option>
                                    <option value="Mengajukan verifikasi">Mengajukan Verifikasi</option>
                                    <option value="Perbaikan verifikasi">Perbaikan Verifikasi</option>
                                    <option value="Terverifikasi">Terverifikasi</option>
                                </select>
                                @error('verifikasi_user')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-control @error('status_user') is-invalid @enderror" name="status_user">
                                    <option value="{{$user->status}}" selected disabled>{{$user->status}}</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non-aktif">Non-aktif</option>
                                </select>
                                @error('status_user')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catatan Verifikasi</label>
                        <textarea class="form-control @error('catatan_verifikasi_user') is-invalid @enderror" name="catatan_verifikasi_user" placeholder="Masukkan catatan verifikasi" rows="3" spellcheck="disabled" required>{{$user->catatan_verifikasi}}</textarea>
                        @error('catatan_verifikasi_user')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-2 mb-3">
                        <span class="text-center">Foto KTP</span>
                        <div class="position-relative">
                            <img src="{{url('images/verifikasi-users/'.$user->file_verifikasi)}}" class="rounded d-block" alt="..." style="width: 500px; max-height: 500px; margin-top: 10px;">
                        </div>
                        <form id="deleteFoto{{$user->id}}" action="{{ route('admin-master-delete-foto-user', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger mr-2 mt-2" data-toggle="modal" data-target="#confirmationModal{{ $user->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>
                    @if($user->file_verifikasi <= 0) <div class="mb-3">
                        <label for="upload_foto" class="form-label">Upload Foto KTP</label>
                        <input class="form-control @error('upload_foto') is-invalid @enderror" type="file" id="upload_foto" name="upload_foto" required>
                        @error('upload_foto')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                </div>
                @endif
                <div class="mb-3 mt-5 text-center">
                    <button form="editSubmit" type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel{{ $user->id }}">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus foto ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('deleteFoto{{ $user->id }}').submit();">Hapus</button>
            </div>
        </div>
    </div>
</div>
@endsection