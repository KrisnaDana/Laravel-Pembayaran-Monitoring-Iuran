@extends('layout.pluto')

@section('content')
<div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <h2>Dashboard</h2>
        </div>
    </div>
</div>
<div style="display: flex; flex-wrap: wrap;">
    <div class="card bg-primary mx-2 text-white" style="max-width: 18rem;">
        <div class="card-body text-white">
            <h5 class="card-title text-white">Total Dana Terkumpul</h5>
            <p class="card-text text-white">@currency($terkumpul)</p>
        </div>
    </div>
    <div class="card bg-danger mx-2 text-white" style="max-width: 18rem;">
        <div class="card-body text-white">
            <h5 class="card-title text-white">Total Dana Digunakan</h5>
            <p class="card-text text-white">@currency($digunakan)</p>
        </div>
    </div>
    <div class="card bg-success mx-2 text-white" style="max-width: 18rem;">
        <div class="card-body text-white">
            <h5 class="card-title text-white">Total Dana Tersisa</h5>
            <p class="card-text text-white">@currency($tersisa)</p>
        </div>
    </div>
</div>
@endsection