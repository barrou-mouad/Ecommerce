@include('layouts.app')
<div class="container">
    <div id="msg" class="alert alert-success" style="display: none">Le produit est ajouté avec success</div>
<div class="row">
    <div class="col-lg-7 col-sm-12 d-block">
        <div class="card mx-auto" style="width: 30rem; height:560px">
            <h5 class="card-header">{{$produit->title}}</h5>
            <img src="{{asset('/images/'. $produit->image )}}" width="100px" height="340px" class="card-img-top" alt="...">
            <div class="card-body">
                <div class="row container d-flex justify-content-between">
                   <div class="p-2" style="font-size: 25px">{{$produit->price}} DH</div> @if($produit->old_price>0) <div class="p-2" style="font-size:20px "><strike class="text-danger"> {{$produit->old_price}} DH</strike></div> @endif
                </div>

              <p class="card-text" style="font-size: 20px"><b>Description : </b>{{$produit->desc}}</p>
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
              <a href="{{route('like',$produit->id)}}" class="btn btn-block btn-btn-outline-danger-danger"><i class="fas fa-heart"></i> {{count($produit->likes)}}</a>
              @endguest

            </div>
          </div>
    </div>
    <div class="col-lg-5 col-sm-12 d-block">
<form class="mx-auto my-sm-2" action="" method="post" style="width: 30rem">

    <label>La quantité </label>
    <input class="form-control" id="qty" placeholder="quantiité" value="1" type="number" min="1" max="@if(Cart::has($produit->id)){{$produit->in_stock-Cart::get($produit->id)->quantity}}@else{{$produit->in_stock}}@endif">
    <input onclick="addtocart({{$produit->id}})"value="ajouter au panier" class="btn btn-block btn-dark my-2">
</form>
    </div>
</div>
</div>
