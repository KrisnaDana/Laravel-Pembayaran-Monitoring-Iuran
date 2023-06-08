@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Pembayaran</h2>
                </div>
                <div class="col">
                    <a href="#"><button type="button" class="btn cur-p btn-lg btn-success mr-3" style="float: right;">Tambah</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" class="bg-transparent" style="background-color:transparent;">
        <li class="breadcrumb-item active" aria-current="page">Pilih Iuran</li>
    </ol>
</nav>
<div class="row">
    <div class="col">
        <div class="white_shd full margin_bottom_30">
            <div class="table_section padding_infor_info">
                <div class="table-responsive-sm table-bordered"> <!--  <div class="table-responsive-sm" style="min-width:max-content"> -->
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Iuran</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($iurans as $iuran)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$iuran->nama}}</td>
                                <td class="text-center">
                                    <a href="{{route('admin-read-iuran', ['id' => $mahasiswa->id])}}"><button type="button" class="btn btn-primary"><i class="fa fa-book text-white"></i></button></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="reset-password-modal{{$loop->index+1}}">
                                <form method="get" action="{{route('admin-reset-password-iuran', ['id' => $mahasiswa->id])}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Konfirmasi</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin mereset password akun mahasiswa {{$mahasiswa->nim}} - {{$mahasiswa->nama_lengkap}}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Ya</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal fade" id="delete-modal{{$loop->index+1}}">
                                <form method="post" action="{{route('admin-delete-iuran', ['id' => $mahasiswa->id])}}">
                                    @csrf
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Konfirmasi</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus mahasiswa {{$mahasiswa->nim}} - {{$mahasiswa->nama_lengkap}}?
                                                <input type="text" class="form-control mt-3" name="nim" spellcheck="disabled" required placeholder="Ketik NIM mahasiswa untuk konfirmasi">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Ya</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection