@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        @foreach ($likes as $produit)
        <div class="col-4 my-3">
      <div class="card" style="width: 15rem;">
      <img src="{{asset('/images/'. $produit->produit->image )}}" height="225px" class="card-img-top" alt="...">
      <div class="card-body text-center">
        <h5 class="card-title">{{ $produit->produit->title }}</h5>
        <p class="card-text"> Price: {{ $produit->produit->price }} DH</p>
        <div class="d-flex  justify-content-center">
            <a href="/getproduit/{{$produit->produit->id}}" class="btn btn-primary mr-2">Détails</a>
        @auth
        @php
            $flag=false;
        @endphp
        @foreach ($produit->produit->likes as $l)
        @if($l->user_id==Auth::id())
        @php
        $flag=true  ;
        @endphp
        @endif
        @endforeach
        @if ($flag)
        <a href="{{route('dislike',$produit->produit->id)}}" class="btn btn-block btn-danger"><i class="fas fa-heart"></i></a>
        @else
        <a href="{{route('like',$produit->produit->id)}}" class="btn btn-block btn-outline-danger"><i class="fas fa-heart"></i></a>
        @endif
        @endauth
        @guest
        <a href="{{route('like',$produit->produit->id)}}" class="btn btn-block btn-danger"><i class="fas fa-heart"></i></a>
        @endguest

        </div>
      </div>
    </div>
</div>
    @endforeach
    </div>

</div>

@endsection
