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
        <div class="card" style="width: 15rem; height:200px">
        <img src="{{asset('/images/'. $produit->image )}}" height="225px" class="card-img-top" alt="...">
        <div class="card-body text-center">
          <h5 class="card-title">{{ $produit->title }}</h5>
          <p class="card-text"> Price: {{ $produit->price }} DH</p>
          <div class="d-flex  justify-content-center">
              <a href="/getproduit/{{$produit->id}}" class="btn btn-primary mr-2">Détails</a>
            @auth
            @php
              $flag=false;
          @endphp
          @foreach ($produit->likes as $like)
            @if($like->user_id==Auth::id())
            @php
              $flag=true  ;
            @endphp
            @endif
          @endforeach
          @if ($flag)
          <a href="{{route('dislike',$produit->id)}}" class="btn btn-block btn-danger"><i class="fas fa-heart"></i> {{count($produit->likes)}}</a>
          @else
          <a href="{{route('like',$produit->id)}}" class="btn btn-block btn-outline-danger"><i class="fas fa-heart"></i> {{count($produit->likes)}}</a>
          @endif
        @endauth
        @guest
        <a href="{{route('like',$produit->id)}}" class="btn btn-block btn-outline-danger"><i class="fas fa-heart"></i> {{count($produit->likes)}}</a>
        @endguest

          </div>
        </div>
      </div>
      @endforeach
</div>

</div>

@endsection

