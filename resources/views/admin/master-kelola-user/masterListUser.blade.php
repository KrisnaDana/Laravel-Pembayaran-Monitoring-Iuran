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

<div class="row column1">
    <div class="col-md-6 col-lg-3">
        <div class="full counter_section margin_bottom_30 yellow_bg">
            <div class="couter_icon">
                <div>
                    <i class="fa fa-sign-in"></i>
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
                    <p class="head_couter">Total User</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row column2 graph margin_bottom_30">
    <div class="col-md-12 col-lg-12">
        <div class="button_block">
            <a type="button" href="{{ route('admin-master-create-user') }}" class="btn cur-p btn-primary">
                <i class="fa fa-plus">&nbsp;</i>Tambah Data User
            </a>
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
                                    <form id=" " action="" method="POST">
                                        @csrf
                                        <a type="button" class="btn btn-primary" href="">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a type="button" class="btn btn-warning " href="{{ route('admin-master-edit-user', $user->id) }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="">
                                            <i class="fa fa-trash"></i>
                                    </form>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection