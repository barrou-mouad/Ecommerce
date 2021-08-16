@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-bold text-capitalize">Information personelle </div>

                <div class="card-body">
               <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Nom</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{auth::user()->name}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{auth::user()->email}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Télé</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{auth::user()->number_phone}}
                </div>
              </div>
              <hr>
              <div class="row">
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
</div>
<div class="row justify-content-center my-2">
    <div class="col-8">
        <div class="row">
            <div class="col-12 d-flex justify-content-between ">
                <a href="{{route('mycommandes')}}" class="card bg-success ml-5" style="width: 275px; text-align: center;">
                    <h3 class="card-title text-white " >Mes Commandes</h3>

                    <img class="card-img image mx-auto"  src="{{ asset('images/icons/order.png') }}" style="width: 90px;" >
                   <h4 class="text-white">{{count(auth::user()->commandes)}}</h4>
                </a>
                <a href="{{route('favorite')}}" class="card bg-dark mr-5" style="width: 275px; text-align: center;">
                    <h3 class="card-title text-white " >Mes Préférés</h3>

                    <img class="card-img image mx-auto"  src="{{ asset('images/icons/favori.png') }}" style="width: 90px;" >
                   <h4 class="text-white">{{count(auth::user()->likes)}}</h4>
                </a>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
