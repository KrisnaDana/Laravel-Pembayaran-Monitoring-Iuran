@extends('layout.pluto')

@section('page_title','List User')

@section('content')

<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>List User</h2>
        </div>
    </div>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" class="bg-transparent" style="background-color:transparent;">
        <li class="breadcrumb-item active" aria-current="page">List User</li>
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
                    if($user->verifikasi == 'Terverifikasi'){
                    $counter++;
                    }
                    }
                    @endphp
                    <p class="total_no">{{$counter}}</p>
                    <p class="head_couter">Total User</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="row column2 graph margin_bottom_30">
            <div class="col-md-8">
                <div class="button_block">
                    <a type="button" href="{{ route('admin-create-user') }}" class="btn cur-p btn-primary">
                        <i class="fa fa-plus">&nbsp;</i>Tambah Data User
                    </a>
                    <div class="btn-group">
                        <a type="button" href="{{ route('admin-view-list-verifikasi-user') }}" class="btn cur-p btn-secondary">
                            <i class="fa fa-user">&nbsp;</i>List Verifikasi
                        </a>
                    </div>
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
                            @if($user->verifikasi == 'Terverifikasi')
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->nama}}</td>
                                <td>{{$user->telepon}}</td>
                                <td>{{Illuminate\Support\Str::limit($user->alamat, $limit = 20, $end = '...')}}</td>
                                <td>{{$user->verifikasi}}</td>
                                <td>{{$user->status}}</td>
                                <td class="align-middle text-center" style="width: 20%;">
                                    <div class="d-flex justify-content-center">
                                        <a type="button" class="btn btn-primary mr-2" href="{{ route('admin-detail-user', $user->id) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a type="button" class="btn btn-warning mr-2" href="{{ route('admin-edit-user', $user->id) }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form id="deleteForm{{$user->id}}" action="{{ route('admin-delete-user', $user->id) }}" method="POST">
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
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection