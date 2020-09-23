@extends('layout')
@section('content')
<div class="container">
    <div class="row d-flex justify-content-center mt-5">
        @foreach ($datas['data'] as $key=>$data)
        <div class="col-lg-4 my-2">
            <div class="card" style="width: 18rem;">
                <a href="/dstv/{{$key}}">
                    <div class="card-body">
                        <h5 class="card-title text-success font-weight-bold">{{$data['name']}}</h5>
                        <p class="card-subtitle mb-2 text-muted">{{$data['description']}}</p>
                        <p class="card-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos</p>

                      </div>
                </a>
              </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
