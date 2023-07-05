@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>Pembayaran</h2>
        </div>
    </div>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" class="bg-transparent" style="background-color:transparent;">
        <li class="breadcrumb-item"><u class="blue1_color"><a class="blue1_color" href="{{route('admin-view-pembayaran-pilih-iuran')}}">Pilih Iuran</a></u></li>
        <li class="breadcrumb-item"><u class="blue1_color"><a class="blue1_color" href="{{route('admin-view-pembayaran', ['id' => $iuran_id])}}">List Pembayaran</a></u></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Pembayaran</li>
    </ol>
</nav>
<div class="row column3 graph">
    <div class="col-md-12 col-lg-12">
        <div class="white_shd full">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                <h2>Tambah Pembayaran</h2>
                </div>
            </div>
            <div class="table_section padding_infor_info ">
                <form method="POST" action="{{route('admin-create-pembayaran', ['id' => $iuran_id])}}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">User :</label>
                        <select class="form-control" name="user">
                            @foreach($users as $user)
                                @if(old('user') == $user->id)
                                    <option value="{{$user->id}}" selected>{{$user->username}} - {{$user->nama}}</option>
                                @else
                                    <option value="{{$user->id}}">{{$user->username}} - {{$user->nama}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Pembayaran :</label>
                        <div class="input-group">
                            <span class="input-group-text" style="border-top-right-radius: 0px; border-bottom-right-radius: 00px;">Rp</span>
                            <input autocomplete="off" type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" id="jumlah" spellcheck="disabled" value="{{old('jumlah')}}">
                            @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button style="width:100%;" type="submit" class="model_bt btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection