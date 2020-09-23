
@extends('layout')
@section('content')
<div class="container">
    <div class="text-center">
        <br><br>
        @if ($data['code'] == 200)
        <span><i class="fas fa-check-circle mb-5" style="font-size: 150px; color:#28a745;"></i></span>
        <br>
        <h1>Transaction Successfull!</h1>
        <p>{{$data['message']}}</p>
        <br>
        @elseif($data['code'] == 503)
        <span><i class="fas fa-recycle mb-5 text-warning" style="font-size: 150px;"></i></span>
        <br>
        <h1>Transaction is been processed!</h1>
        <p>Your Transaction is being  processed for some minutes before tryint it again</p>
        <p>{{$data['message']}}</p>
        <br>

        @else
        <span><i class="fas fa-times mb-5 text-danger" style="font-size: 150px;"></i></span>
        <br>
        <h1>Transaction Not Successfull!</h1>
        <p> Error({{$data['code']}}) {{$data['message']}}</p>
        <br>
        @endif
        <a href="/" class="btn btn-outline-dark btb-lg">Back To Dashboard</a>
        <br><br><br>
    </div>
</div>
@endsection
