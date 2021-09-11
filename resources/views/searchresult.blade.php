@extends('layouts.app')

@section('content')
<div class="container">
    <div  class="row my-2 text-center">
        <div class="col-4"><h3>Catégorie :   {{$categorie}}</h3></div>
        <div class="col-4"><h3>Prix min :   {{$priceMin}}</h3></div>
        <div class="col-4"><h3>Prix max :   {{$priceMax}}</h3></div>



    </div>
    <hr>
    <div class="d-flex justify-content-center align-content-between mr-2">

        @foreach ($produits as $produit)
        <div class="col-xl-3 col-md-6 col-sm-12 my-sm-2">
            <div class="card bg-light text-center mx-auto h-100" style="width: 15rem;min-height: 360px">
                <img src="{{asset('/images/'. $produit->image )}}" class="card-img-top bg-bluesky" width="50px" height="200px" alt="...">
                <div class="card-body bg-bluesky-bottom">
                    <hr>
                  <h5 class="card-title"> {{Str::limit($produit->title , 10,) }}</h5>
                  <p class="card-text"><del>@if ($produit->old_price>0) {{$produit->old_price}} DH @endif</del> <span class="price">{{ $produit->price}} DH</span> </p>
                  <div class="show1">
                    <a href="getproduit/{{ $produit->id }}" class="btn btn-light"><i class="fas fa-eye"></i></a>
                    <button class="btn btn-light my-3"><i class="fas fa-heart"></i></button>
                    <button  onclick="addtocart({{$produit->id}})"  class="btn btn-light"><i class="fas fa-shopping-cart"></i></button>
                  </div>

                </div>
              </div>
            </div>


      @endforeach
</div>

</div>

@endsection

