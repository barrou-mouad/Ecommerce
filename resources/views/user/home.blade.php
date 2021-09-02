@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center my-5" >
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header text-bold text-capitalize bg-bluesky">Information personelle </div>

                <div class="card-body bg-bluesky-bottom text-bold">
               <div class="row my-2">
                <div class="col-sm-3">
                  <h6 class="mb-0">Nom</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{auth::user()->name}}
                </div>
              </div>
              <hr>
              <div class="row my-2">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{auth::user()->email}}
                </div>
              </div>
              <hr>
              <div class="row my-2">
                <div class="col-sm-3">
                  <h6 class="mb-0">Télé</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{auth::user()->number_phone}}
                </div>
              </div>
              <hr>
              <div class="row my-2">
                <div class="col-sm-3">
                  <h6 class="mb-0">Addresse</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{auth::user()->address}}
                </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-4 justify-content-center my-0">
        <div class="row justify-content-center">
            <div class="col-12">
            <a href="{{route('mycommandes')}}" class="card bg-bluesky-bottom  text-dark" style="width: 265px; text-align: center;">
                <h3 class="card-title text-dark " >Mes Commandes</h3>

                <img class="card-img image mx-auto"  src="{{ asset('images/icons/order.png') }}" style="width: 60px;" >
               <h4 class="text-white">{{count(auth::user()->commandes)}}</h4>
            </a>
        </div>

        <div class="col-12 mt-3">
            <a href="{{route('favorite')}}" class="card bg-bluesky-bottom  " style="width: 265px; text-align: center;">
                <h3 class="card-title text-dark " >Mes Préférés</h3>

                <img class="card-img image mx-auto"  src="{{ asset('images/icons/favori.png') }}" style="width: 60px;" >
               <h4 class="text-white">{{count(auth::user()->likes)}}</h4>
            </a>
        </div>
    </div>

</div>
</div>
@endsection
