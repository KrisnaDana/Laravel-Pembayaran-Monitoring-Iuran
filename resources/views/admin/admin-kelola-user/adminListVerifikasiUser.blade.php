@extends('layout.pluto')

@section('page_title','List User')

@section('content')

<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>List Verifikasi User</h2>
                </div>
                <div class="col">
                    <a href="{{ route('admin-view-list-user') }}"><button type="button" class="btn cur-p btn-lg btn-danger" style="float: right;">Kembali</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" class="bg-transparent" style="background-color:transparent;">
        <li class="breadcrumb-item"><u class="blue1_color"><a class="blue1_color" href="{{route('admin-view-list-user')}}">List User</a></u></li>
        <li class="breadcrumb-item active" aria-current="page">List Verifikasi User</li>
    </ol>
</nav>
<div class="row column1">
    <div class="col-md-6 col-lg-3">
        <div class="full counter_section margin_bottom_30 yellow_bg">
            <div class="couter_icon">
                <div>
                    <i class="fa fa-user"></i>
                </div>
            </div>
            <div class="counter_no">
                <div>
                    @php
                    $counter = 0;
                    foreach($users as $user){
                    $counter++;
                    }
                    @endphp
                    <p class="total_no">{{$counter}}</p>
                    <p class="head_couter">Total User Belum Terverifikasi</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row column3 graph margin_bottom_30">
    <div class="col-md-l2 col-lg-12">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>Tabel Data User</h2>
                </div>
            </div>
            <div class="table_section padding_infor_info ">
                <div class="table-responsive-sm">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Verifikasi</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->nama}}</td>
                                <td>{{$user->telepon}}</td>
                                <td>{{Illuminate\Support\Str::limit($user->alamat, $limit = 20, $end = '...')}}</td>
                                <td>{{$user->verifikasi}}</td>
                                <td>{{$user->status}}</td>
                                <td class="align-middle text-center" style="width: 20%;">
                                    <div class="d-flex justify-content-center">
                                        <a type="button" class="btn btn-success mr-2" href="{{ route('admin-detail-verifikasi-user', $user->id) }}">
                                            <i class="fa fa-check"></i>
                                        </a>
                                        <a type="button" class="btn btn-warning mr-2" href="{{ route('admin-edit-verifikasi-user', $user->id) }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form id="deleteForm{{$user->id}}" action="{{ route('admin-delete-verifikasi-user', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger mr-2" data-toggle="modal" data-target="#confirmationModal{{ $user->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
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
                                            <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('deleteForm{{ $user->id }}').submit();">Hapus</button>
                                        </div>
                                    </div>
                                </div>
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