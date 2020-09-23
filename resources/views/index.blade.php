@extends('layout')
@section('content')
<div class="container">
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-lg-4">
            <div class="card" style="width: 18rem;">
              <a href="/dstv">
                <img src="/img/DStv_Logo_2012.png" class="card-img-top img-fluid rounded" style="height: 150px; object-fit: cover;" alt="...">
                <div class="card-body">
                    <h5 class=" font-weight-bold text-success">DStv </h5>
                    <p class="card-text">Recharge DStv Subscription.</p>
                </div>
              </a>
              </div>
        </div>
        <div class="col-lg-4">
            <div class="card" style="width: 18rem;">
               <a href="/ekedc">
                <img src="/img/EKDC.jpg" class="card-img-top img-fluid rounded" style="height: 150px; object-fit: cover;" alt="...">
                <div class="card-body">
                    <h5 class=" font-weight-bold text-success">EKEDC </h5>
                  <p class="card-text">Recharge Eko Electricity Bill</p>
                </div>
               </a>
              </div>
        </div>
    </div>
</div>
@endsection
