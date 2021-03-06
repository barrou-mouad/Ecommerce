
@extends('layouts.app')
@section('content')
<div class="container">
    <div id="msg" class="alert alert-success" style="display: none">Le produit est ajouté avec success</div>
<div class="row my-2 bg-bluesky-bottom">
    <div class="col-lg-7 col-sm-12 d-block">
        <div class="card mx-auto" style="width: 30rem;">
            <h5 class="card-header bg-bluesky text-center">{{$produit->title}}</h5>
            <img src="{{asset('/images/'. $produit->image )}}" width="100px" height="390px" class="card-img-top" alt="...">

          </div>
    </div>
    <div class="col-lg-5 col-sm-12 d-block border">

<div class="d-flex justify-content-start align-items-center">

<div class="mr-5 my-2" style="font-size: 25px">{{$produit->price}} DH</div>
</div>




          <div class="text-left my-2"  style="font-size: 20px"><b>In stock : </b> @if ($produit->in_stock>0)
              <span class="text-success">Disponible</span>
          @else
          <span class="text-danger ">Indisponible</span>
          @endif</div>
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
          <hr>
          <span class="my-2">Détails du produit :</span>
          <div class="text-left"  style="font-size: 20px">{{$produit->desc}}</div>
        <hr>
<form class="mx-auto my-sm-2" action="" method="post" >

    <label>La quantité </label>
    <input class="form-control" id="qty" placeholder="quantiité" value="1" type="number" min="1" max="@if(Cart::has($produit->id)){{$produit->in_stock-Cart::get($produit->id)->quantity}}@else{{$produit->in_stock}}@endif">
    @if ($produit->in_stock>0)
    <input onclick="addtocart({{$produit->id}})" value="ajouter au panier" class="btn btn-block btn-dark my-2">
    @else
    <span class="text-danger">Indisponible</span>
    @endif

</form>
    </div>
</div>
</div>

@endsection
