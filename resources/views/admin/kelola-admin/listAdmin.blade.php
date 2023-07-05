@extends('layout.pluto')

@section('page_title','List Admin')

@section('content')

<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>List Admin</h2>
        </div>
    </div>
</div>

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
                    foreach($admins as $admin){
                    if($admin->role == 'Admin'){
                    $counter++;
                    }
                    }
                    @endphp
                    <p class="total_no">{{$counter}}</p>
                    <p class="head_couter">Total Admin</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row column2 graph margin_bottom_30">
    <div class="col-md-12 col-lg-12">
        <div class="button_block">
            <a type="button" href="{{ route('admin-master-create-admin') }}" class="btn cur-p btn-primary">
                <i class="fa fa-plus">&nbsp;</i>Tambah Data Admin
            </a>
        </div>
    </div>
</div>

<div class="row column3 graph margin_bottom_30">
    <div class="col-md-l2 col-lg-12">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>Tabel Data Admin</h2>
                </div>
            </div>
            <div class="table_section padding_infor_info ">
                <div class="table-responsive-sm">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Username</th>
                                <!-- <th>Password</th> -->
                                <th>Role</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                            @if($admin->role == 'Admin')
                            <tr>
                                <td>{{$loop->iteration-1}}</td>
                                <td>{{$admin->username}}</td>
                                <!-- <td>{{Illuminate\Support\Str::limit($admin->password, $limit = 10, $end = '...')}}</td> -->
                                <td>{{$admin->role}}</td>
                                <td>{{$admin->nama}}</td>
                                <td class="align-middle text-center" style="width: 20%;">
                                    <div class="d-flex justify-content-center">
                                        <a type="button" class="btn btn-primary mr-2" href="{{ route('admin-master-detail-admin', $admin->id) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a type="button" class="btn btn-warning mr-2" href="{{ route('admin-master-edit-admin', $admin->id) }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form id="deleteForm{{$admin->id}}" action="{{ route('admin-master-delete-admin', $admin->id)   }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger mr-2" data-toggle="modal" data-target="#confirmationModal{{ $admin->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <!-- Confirmation Modal -->
                            <div class="modal fade" id="confirmationModal{{ $admin->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel{{ $admin->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmationModalLabel{{ $admin->id }}">Konfirmasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('deleteForm{{ $admin->id }}').submit();">Hapus</button>
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