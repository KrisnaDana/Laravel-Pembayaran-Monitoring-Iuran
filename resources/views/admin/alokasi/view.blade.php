@extends('layout.pluto')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <div class="row">
                <div class="col" style="position: absolute; top: 50%; transform: translateY(-50%);">
                    <h2>Alokasi</h2>
                </div>
                <div class="col">
                    <a href="{{ route('admin-create-alokasi', ['id' => $iurans->id]) }}"><button type="button" class="btn cur-p btn-lg btn-primary" style="float: right;">Tambah Alokasi Dana</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb" class="bg-transparent" style="background-color:transparent;">
        <li class="breadcrumb-item"><u class="blue1_color"><a class="blue1_color" href="{{route('admin-preview-alokasi')}}">Pilih Iuran</a></u></li>
        <li class="breadcrumb-item active" aria-current="page">List Alokasi</li>
    </ol>
</nav>

<div class="row column3 graph margin_bottom_30">
    <div class="col-md-l2 col-lg-12">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                <h2>List Alokasi</h2>
                </div>
            </div>
            <div class="table_section padding_infor_info ">
                <div class="table-responsive-sm">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            {{-- <th>Foto</th> --}}
                            <th>Jumlah</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alokasis as $alokasi)
                        @if ($alokasi->iuran_id == $iurans->id )
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$alokasi->nama}}</td> 
                                <td>{{$alokasi->deskripsi}}</td>
                                {{-- <td>
                                    <img src="{{ asset('alokasi_foto/' . $alokasi->foto) }}" alt="Alokasi Foto" width="200" height="200">
                                </td>                             --}}
                                <td>@currency($alokasi->jumlah)</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin-edit-alokasi', ['iuranId' => $iurans->id, 'alokasiId' => $alokasi->id]) }}" class="btn btn-success mr-2">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="{{ route('admin-detail-alokasi', ['iuranId' => $iurans->id, 'alokasiId' => $alokasi->id]) }}" class="btn btn-warning mr-2">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form id="deleteForm{{ $alokasi->id }}" action="{{ route('admin-delete-alokasi', ['iuranId' => $iurans->id, 'alokasiId' => $alokasi->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger mr-2" data-toggle="modal" data-target="#confirmationModal{{ $alokasi->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>                                                                                
                                    </div>
                                </td>

                                <!-- Confirmation Modal -->
                                <div class="modal fade" id="confirmationModal{{ $alokasi->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel{{ $alokasi->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmationModalLabel{{ $alokasi->id }}">Confirmation</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this item?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('deleteForm{{ $alokasi->id }}').submit();">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
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