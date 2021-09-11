@extends('layouts.app')

@section('content')
<div id="msg" class="alert alert-success" style="display: none">Le produit est ajouté avec success</div>

    <div class="mb-2 rounded-4 shadow w-100" style="border-radius: 10px;background-color: #ef9273 !important;">
        <div id="carouselExampleCaptions" class="carousel slide text-dark text-dark" data-ride="carousel">
            <ol class="carousel-indicators">
                @for ($i=0;$i<count($reduction);$i++)

               @if($i==0)
              <li data-target="#carouselExampleCaptions" data-slide-to="{{$i}}" class="active text-dark"></li>
               @else
              <li data-target="#carouselExampleCaptions" data-slide-to="{{$i}}" class="text-dark"></li>
              @endif
              @endfor
            </ol>
            <div class="carousel-inner text-dark">
                @php
                    $i=0;
                @endphp
                @foreach ($reduction as $produit )
                @if($i==0)
                <div class="carousel-item active container">

                    <img src="{{ asset('images/'.$produit->image)}}" style="height: 400px !important"  class="" alt="...">
                    <div class="carousel-caption d-none d-md-block text-dark "  >

                        <h5 class="text-dark">{{$produit->title}}</h5>
                        <p class="text-dark">{{$produit->desc}}</p>

                        <a href="getproduit/{{ $produit->id }}" class="btn0 my-3 shadow">Détails</a>
                    </div>
                    <div class="promo">-{{round(($produit->old_price-$produit->price)*100/$produit->old_price, 2);}}%</div>
                </div>
            @else
            <div class="carousel-item container">

                <img src="{{ asset('images/'.$produit->image)}}" style="height: 400px !important"  class="" alt="...">
                <div class="carousel-caption d-none d-md-block text-dark "  >

                    <h5 class="text-dark">{{$produit->title}}</h5>
                    <p class="text-dark">{{$produit->desc}}</p>

                    <a href="getproduit/{{ $produit->id }}" class="btn0 my-3 shadow">Détails</a>
                </div>
                <div class="promo">-{{round(($produit->old_price-$produit->price)*100/$produit->old_price, 2);}}%</div>
            </div>
            @endif
            @php
                $i++;
            @endphp
              @endforeach
            </div>
            <a class="carousel-control-prev text-dark" href="#carouselExampleCaptions" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next text-dark" href="#carouselExampleCaptions" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
    </div>
    <div onload="selected()" class="mycontainer">
    <!-- Search form start-->
    <form action="{{route('deepsearch')}}" method="post">
     @csrf
    <div class="row my-4 justify-content-center d-flex">

        <div class="col-3 justify-content-center d-flex">
            <select name="catSearch" class="form-control" id="">
            <option disabled selected>Categorie</option>
                @foreach ($categories as $categorie)
                <option  value="{{$categorie->id}}">{{$categorie->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-9">
            <div class="row justify-content-center d-flex">
            <div class="col-4"><div class="input-group mb-3">
                <input name="priceMin" min="1" type="number" class="form-control" placeholder="Prix Min" aria-label="Username" aria-describedby="basic-addon1">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"style="background-color:#FFC074;border-raduis:10px;color:white;margin-left:-1px" >DH</span>
                  </div>
            </div>
            </div>
            <div class="col-4"><div class="input-group mb-3">
                <input name="priceMax" min="1" type="number" class="form-control" placeholder="Prix Max" aria-label="Username" aria-describedby="basic-addon1">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="background-color:#FFC074;border-raduis:10px;color:white;margin-left:-1px">DH</span>
                  </div>
            </div></div>
    <div class="col-4"><input type="submit" class="btn btn-primary btn-block searchsub" value="Chercher" style="background-color: #eaf8f8 !important; color:black !important"> </div>
        </div>
        </div>

    </div>
    </form>
    <!-- Search form end-->
                <div  class="row">
               <div class=" col-xl-2 col-lg-3 col-md-12 col-xs-12 text-center categorie p-0 mt-4" id="cat">
                <nav class='animated bounceInDown my-2 ml-auto'>
                    <ul class="cat mx-auto">

  @foreach ($categories as $cat)
  <li class="cate" id="{{$cat->id}}" ><a  href='{{route('getProdByCat',$cat->id)}}'>{{$cat->title}} <span class="float-right">{{$cat->produits->count()}}</span></a></li>
  @endforeach
                    </ul>
                </nav>
                </div>

               <div class="col-xl-10 col-lg-9 col-md-12 col-xs-12 my-sm-4">

               <div id="prods">
                @if (app('request')->is('getproduits/*'))
                <input type="hidden" id="catID" value="{{app('request')->id}}">
                @else
                <input type="hidden" id="catID" value="0">
                @endif

                <div id="produit" class="favorite ">


<div class="row d-flex justify-content-between align-content-between">
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
                <div class="row my-1" >
                    <div class="col-md-12 w-25 d-flex justify-content-center mx-auto">
                        {!! $produits->links() !!}
                    </div>
                </div>
                </div>
                </div>
               </div>

               <input class="form-control" type="hidden" id="qty" value="1">
            </div>








<h2 class="title mb-2">famous product</h2>








               {{--  <h2 class="title my-3" >Les produits les plus aimées</h2> --}}
            <div class="owl-carousel favorite d-flex justify-content-center ">
                @foreach ($favorites as $favorite)
                <div class="col-lg-3 col-md-3   col-sm-12 ">
                <div class="card bg-light text-center mx-auto h-100" style="width: 16rem;min-height: 360px">
                    <img src="{{asset('/images/'. $favorite->image )}}" class="card-img-top bg-bluesky" width="50px" height="200px" alt="...">
                    <div class="card-body bg-bluesky-bottom">
                        <hr>
                      <h5 class="card-title"> {{Str::limit($favorite->title , 10,) }}</h5>
                      <p class="card-text"><del>@if ($favorite->old_price>0) {{$favorite->old_price}} DH @endif</del> <span class="price">{{ $favorite->price}} DH</span></p>
                      <div class="show1">
                        <a href="getproduit/{{ $favorite->id }}" class="btn btn-light"><i class="fas fa-eye"></i></a>
                        <button class="btn btn-light my-3"><i class="fas fa-heart"></i></button>
                        <button onclick="addtocart({{$produit->id}})" class="btn btn-light"><i class="fas fa-shopping-cart"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>




                                                        <!-- Footer-->

        </div>


@endsection




