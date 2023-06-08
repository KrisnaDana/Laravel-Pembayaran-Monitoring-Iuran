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

<!-- <div class="row column1">
    <div class="col-md-6 col-lg-3">
        <div class="full counter_section margin_bottom_30 yellow_bg">
            <div class="couter_icon">
                <div>
                    <i class="fa fa-sign-in"></i>
                </div>
            </div>
            <div class="counter_no">
                <div>
                    <p class="total_no">2500</p>
                    <p class="head_couter">Total Penerimaan</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="full counter_section margin_bottom_30 blue1_bg">
            <div class="couter_icon">
                <div>
                    <i class="fa fa-sign-out"></i>
                </div>
            </div>
            <div class="counter_no">
                <div>
                    <p class="total_no">123.50</p>
                    <p class="head_couter">Total Pengeluaran</p>
                </div>
            </div>
        </div>
    </div>
</div> -->

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
                                <th>Password</th>
                                <th>Role</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$admin->username}}</td>
                                <td>{{Illuminate\Support\Str::limit($admin->password, $limit = 20, $end = '...')}}</td>
                                <td>{{$admin->role}}</td>
                                <td>{{$admin->nama}}</td>
                                <td class="align-middle">
                                    <form action="" method="POST">
                                        @csrf
                                        <a type="button" class="btn btn-success" href="">
                                            <i class="bi bi-box-arrow-in-down-right"></i>
                                            <span> Detail</span>
                                        </a>
                                        <a type="button" class="btn btn-primary" href="{{ route('admin-master-edit-admin', $admin->id) }}">
                                            <i class="bi bi-pencil-square"></i>
                                            <span> Edit</span>
                                        </a>
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                            <i class="bi bi-trash3"></i>
                                            <span> Delete</span>
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