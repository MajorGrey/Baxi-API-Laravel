@extends('layout')
@section('content')
    <div class="container">
        <div class="mt-5 mx-auto w-50">
            <div class="text-center mb-3">
                <img src="/img/DStv_Logo_2012.png" class="img-fluid rounded" style="height: 100px;" alt="...">
                <br>
            </div>
            <form action="/dstv/pay" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Service Type</label>
                    <input type="text" class="form-control" readonly value="DStv" name="service_type">
                </div>
                <div class="form-group">
                    <label for="">Select Duration</label>
                    <select class="form-control" name="product_monthsPaidFor" id="monthPrice">
                        <option>Select Duration</option>
                        @foreach ($datas['data'][$id]['availablePricingOptions'] as $key=>$data)
                        <option value="{{$data['monthsPaidFor']}}" data-price="{{$data['price']}}">{{$data['monthsPaidFor'].' month @N'.$data['price'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Total Ammount (N)</label>
                    <input type="text" class="form-control" readonly value="" name="total_amount">
                    <input type="hidden" name="product_code" value="{{$datas['data'][$id]['code']}}">
                </div>
                <div class="form-group">
                    <label for="">Smart Card Number</label>
                    <input type="text" value="1122334455" class="form-control" required name="smartcard_number">
                </div>
                <div class="text-center">
                    <button class="btn btn-outline-dark btn-lg btn-block">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
