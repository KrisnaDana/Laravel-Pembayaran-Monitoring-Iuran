@extends('layout.majesty')

@section('content')
<h4 class="text-center">Register</h4>
<form class="pt-3" action="{{route('register')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control form-control-lg @error('username') is-invalid @enderror" placeholder="Username" name="username" value="{{old('username')}}" required>
        @error('username')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-lg @error('nama') is-invalid @enderror" placeholder="Nama Lengkap" name="nama" value="{{old('nama')}}" required>
        @error('nama')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <div class="form-group">
        <input type="number" class="form-control form-control-lg @error('telepon') is-invalid @enderror" placeholder="No Telepon" name="telepon" value="{{old('telepon')}}" required>
        @error('telepon')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-lg @error('alamat') is-invalid @enderror" placeholder="Alamat" name="alamat" value="{{old('alamat')}}" required>
        @error('alamat')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" name="password" required>
        @error('password')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <div class="form-group mb-2">
        <input type="password" class="form-control form-control-lg @error('konfirmasi_password') is-invalid @enderror" placeholder="Konfirmasi Password" name="konfirmasi_password" required>
        @error('konfirmasi_password')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <div class="text-end">
        <a href="{{route('view-login')}}">Sudah punya akun?</a>
    </div>
    
    <div class="mt-3 text-center">
        <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn text-white" type="submit">REGISTER</button>
    </div>
    @if($message = Session::get('error'))
        <div class="alert alert-danger mt-4" role="alert">
            {{$message}}
        </div>
    @endif
    @if($message = Session::get('warning'))
        <div class="alert alert-warning mt-4" role="alert">
            {{$message}}
        </div>
    @endif
    @if($message = Session::get('success'))
        <div class="alert alert-success mt-4" role="alert">
            {{$message}}
        </div>
    @endif
</form>
@endsection