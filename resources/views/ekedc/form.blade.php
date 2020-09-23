@extends('layout')
@section('content')
    <div class="container">
        <div class="mt-5 mx-auto w-50">
            <form action="/dstv/pay" method="POST">
                @csrf

                <div class="form-group">
                    <label for="">Service Type</label>
                    <select class="form-control" name="service_type" >
                        <option value="eko_electric_prepaid"> Eko Electric (PREPAID)</option>
                        <option value="eko_electric_postpaid"> Eko Electric (POSTPAID)</option>
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
