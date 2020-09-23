@extends('layout')
@section('content')
    <div class="container">
        <div class="mt-5 mx-auto w-50">
            <div class="text-center mb-3">
                <img src="/img/EKDC.jpg" class="img-fluid rounded" style="height: 100px;" alt="...">
                <br>
            </div>
            <form action="/ekedc/pay" method="POST">
                @csrf
                <div id="fetcheddetails">
                </div>
                <div class="form-group">
                    <label for="">Name of Service type *</label>
                    <select class="form-control" name="service_type" id="serviceType" >
                        <option > Select Service Type</option>
                        <option data-number="07080259851" value="eko_electric_prepaid"> Eko Electric (PREPAID)</option>
                        <option data-number="101512454501" value="eko_electric_postpaid"> Eko Electric (POSTPAID)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Meter/Account Number *</label>
                    <input type="text" class="form-control" id="ekedc_account_number" required name="account_number">
                </div>
                <div class="form-group">
                    <label for="">Amount To Pay (₦) *</label>
                    <input type="number" class="form-control" required id="ekedc_amount" name="amount">
                </div>
                <div class="form-group">
                    <label for="">Payer Phone Number *</label>
                    <input type="text" class="form-control" required name="phone">
                </div>
                <div class="text-center">
                    <button class="btn btn-outline-dark btn-lg btn-block">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
