@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <div class="py-2">
                <h2>Verifikasi Akun</h2>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30">
            <form method="post" action="{{route('verifikasi')}}" enctype="multipart/form-data">
                @csrf
                <div class="table_section padding_infor_info">
                    <div class="mb-3">
                        <label class="form-label">Status Verifikasi</label>
                        <input type="text" class="form-control" spellcheck="disabled" disabled readonly value="{{$user->verifikasi}}">
                    </div>
                    @if($user->verifikasi == "Perbaikan verifikasi")
                    <div class="mb-3">
                        <label class="form-label">Catatan Verifikasi</label>
                        <textarea class="form-control"rows="3" disabled readonly>{{$user->catatan_verifikasi}}</textarea>
                        <input type="text" class="form-control" spellcheck="disabled" disabled readonly>
                    </div>
                    @endif
                    @if($user->verifikasi == "Belum terverifikasi" || $user->verifikasi == "Terverifikasi")
                    <div class="mb-3">
                        <label class="form-label">File Verifikasi</label>
                        <input type="file" class="form-control @error('file_verifikasi') is-invalid @enderror" name="file_verifikasi" spellcheck="disabled" required>
                        @error('file_verifikasi')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button style="width:100%;" type="submit" class="model_bt btn btn-primary mt-4">Submit</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection