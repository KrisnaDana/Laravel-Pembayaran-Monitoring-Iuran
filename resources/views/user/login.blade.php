@extends('layout.majesty')

@section('content')
<h4 class="text-center">Login</h4>
<form class="pt-3" action="{{route('login')}}" method="POST">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control form-control-lg" placeholder="Username" name="username" required>
    </div>
    <div class="form-group mb-2">
        <input type="password" class="form-control form-control-lg" placeholder="Password" name="password" required>
    </div>
    <div class="text-end">
        <a href="{{route('view-register')}}">Belum punya akun?</a>
    </div>
    
    <div class="mt-3 text-center">
        <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn text-white" type="submit">LOGIN</button>
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