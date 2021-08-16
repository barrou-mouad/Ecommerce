@extends('layouts.app')

@section('content')
<div onload="selected()" class="mycontainer">
    <div class="titre text-bold text-center my-5">
        <hr>
        <h2 class="mytitle" style="color:#0074D9">Rechercher par prix et catégorie</h2>
        <hr class="ligne" >
    </div>
    <!-- Search form start-->
    <form action="{{route('deepsearch')}}" method="post">
     @csrf
    <div class="row my-4 justify-content-center d-flex">

        <div class="col-3 justify-content-center d-flex">
            <select name="catSearch" class="form-control" id="">
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
                    <span class="input-group-text" id="basic-addon1">DH</span>
                  </div>
            </div>
            </div>
            <div class="col-4"><div class="input-group mb-3">
                <input name="priceMax" min="1" type="number" class="form-control" placeholder="Prix Max" aria-label="Username" aria-describedby="basic-addon1">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">DH</span>
                  </div>
            </div></div>
            <div class="col-4"><input type="submit" class="btn btn-primary btn-block" value="Chercher"> </div>
        </div>
        </div>

    </div>
    </form>
    <!-- Search form end-->
                <div  class="row">
               <div class="col-xl-2 col-lg-3 col-md-4 col-xs-12 text-center list-group p-0 " style="border: 1px solid rgb(18, 18, 190)" id="cat">
                <h3 class="text-center mb-4" >Catégories </h3>
                <a href="/" class="list-group-item list-group-item-action cat    @if (app('request')->is('/')) active @endif">latest</a>
                @foreach ($categories as $categorie)
                <a id="{{$categorie->id}}" href="{{ route('getProdByCat',$categorie->id) }}"  class="list-group-item list-group-item-action cat">{{$categorie->title}} ({{count($categorie->produits)}})</a>
                @endforeach
                </div>

               <div class="col-xl-10 col-lg-9 col-md-8 col-xs-12">

               <div id="prods">
                @if (app('request')->is('getproduits/*'))
                <input type="hidden" id="catID" value="{{app('request')->id}}">
                @else
                <input type="hidden" id="catID" value="0">
                @endif
                <div class="d-flex justify-content-between align-content-between mr-2">



                    @foreach ($produits as $produit)
                  <div class="card" style="width: 20rem;">
                  <img src="{{asset('/images/'. $produit->image )}}" height="225px" class="card-img-top img-fluid" alt="...">
                  <div class="card-body text-center">
          l          <h5 class="card-title">{{ $produit->title }}</h5>
          <div class="row   @if($produit->old_price>0) container  d-flex justify-content-between @else d-flex justify-content-center @endif">
          <div class="p-2 text-center" style="font-size: 25px">{{$produit->price}} DH</div> @if($produit->old_price>0) <div class="p-2" style="font-size:20px "><strike class="text-danger"> {{$produit->old_price}} DH</strike></div> @endif
          </div>
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
                <div class="row my-4" >
                    <div class="col-md-12 w-25 d-flex justify-content-center mx-auto">
                        {!! $produits->links() !!}
                    </div>
                </div>
                </div>
               </div>


            </div>
            <div class="titre text-bold text-center my-5">
                <hr>
                <h2 class="mytitle" style="color:#0074D9">Les réductions</h2>
                <hr class="ligne" >
            </div>
    <div class="bg-dark my-3 rounded-4 shadow" style="border-radius: 10px;">
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
                      <div class="carousel-item active">
                        <img src="{{ asset('images/'.$produit->image)}}" style="height: 400px !important" class="d-block mx-auto img-fluid" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <button class="btn btn-outline-primary">Détails</button>
                            <div class="mt">
                                <span class="bg-success px-3" style="font-size: 30px;font-weight: bolder">{{$produit->price}} DH</span>   <span class="bg-dark px-3 text-danger"  style="font-size: 30px"><strike>{{$produit->old_price}} DH</strike> </span>
                               </div>
                         <!-- <h5><span class="bg-warning px-3"> {{$produit->title}}</span> </h5>-->

                        </div>
                    </div>
                    @else
                    <div class="carousel-item">

                        <img src="{{ asset('images/'.$produit->image)}}" style="height: 400px !important"  class="d-block mx-auto img-fluid" alt="...">
                        <div class="carousel-caption d-none d-md-block mt-5" style="margin-top: 120px" >
                            <button class="btn btn-outline-primary">Détails</button>
                            <div class="mt">
                                <span class="bg-success px-3" style="font-size: 30px;font-weight: bolder">{{$produit->price}} DH</span>   <span class="bg-dark px-3 text-danger"  style="font-size: 30px"><strike>{{$produit->old_price}} DH</strike> </span>
                               </div>
                        </div>
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
            <div class="titre text-bold text-center my-5">
                <hr>
                <h2 class="mytitle" style="color:#0074D9">Les produits les plus aimées</h2>
                <hr class="ligne" >
            </div>

            <div class="owl-carousel d-flex justify-content-between">

                @foreach ($favorites as $favorite)
                <div class="card mx-auto" style="width: 15rem; height:400px">
                <img src="{{asset('/images/'. $favorite->image )}}" style="height: 230px !important" height="225px" class="card-img-top img-fluid" alt="...">
                <div class="card-body text-center">
                  <h5 class="card-title">{{ $favorite->title }}</h5>
                  <p class="card-text"> Price: {{ $favorite->price }} DH</p>
                  <div class="d-flex  justify-content-center">
                      <a href="/getproduit/{{$favorite->id}}" class="btn btn-primary mr-2">Détails</a>
                    @auth
                    @php
                      $flag=false;
                  @endphp
                  @foreach ($favorite->likes as $like)
                    @if($like->user_id==Auth::id())
                    @php
                      $flag=true  ;
                    @endphp
                    @endif
                  @endforeach
                  @if ($flag)
                  <a href="{{route('dislike',$favorite->id)}}" class="btn btn-block btn-danger"><i class="fas fa-heart"></i> {{count($favorite->likes)}}</a>
                  @else
                  <a href="{{route('like',$favorite->id)}}" class="btn btn-block btn-outline-danger"><i class="fas fa-heart"></i> {{count($favorite->likes)}}</a>
                  @endif
                @endauth
                @guest
                <a href="{{route('like',$favorite->id)}}" class="btn btn-block btn-outline-danger"><i class="fas fa-heart"></i> {{count($favorite->likes)}}</a>
                @endguest

                  </div>
                </div>
              </div>
              @endforeach

            </div>

            <footer class="text-center mt-2 footer-dark text-white" style="background-color: #f1f1f1;width: 100%;">
                <div class="container">
                   <!-- Section: Social media -->
                   <section class="mb-4">
                     <!-- Facebook -->
                     <a
                       class="btn btn-link btn-floating btn-lg text-dark m-1"
                       href="#!"
                       role="button"
                       data-mdb-ripple-color="dark"
                       ><i class="fab fa-facebook-f"></i
                     ></a>

                     <!-- Twitter -->
                     <a
                       class="btn btn-link btn-floating btn-lg text-dark m-1"
                       href="#!"
                       role="button"
                       data-mdb-ripple-color="dark"
                       ><i class="fab fa-twitter"></i
                     ></a>

                     <!-- Google -->
                     <a
                       class="btn btn-link btn-floating btn-lg text-dark m-1"
                       href="#!"
                       role="button"
                       data-mdb-ripple-color="dark"
                       ><i class="fab fa-google"></i
                     ></a>

                     <!-- Instagram -->
                     <a
                       class="btn btn-link btn-floating btn-lg text-dark m-1"
                       href="#!"
                       role="button"
                       data-mdb-ripple-color="dark"
                       ><i class="fab fa-instagram"></i
                     ></a>

                     <!-- Linkedin -->
                     <a
                       class="btn btn-link btn-floating btn-lg text-dark m-1"
                       href="#!"
                       role="button"
                       data-mdb-ripple-color="dark"
                       ><i class="fab fa-linkedin"></i
                     ></a>
                     <!-- Github -->
                     <a
                       class="btn btn-link btn-floating btn-lg text-dark m-1"
                       href="#!"
                       role="button"
                       data-mdb-ripple-color="dark"
                       ><i class="fab fa-github"></i
                     ></a>
                   </section>
                   <section class="">
                     <p class="d-flex justify-content-center align-items-center text-dark">
                       <span class="me-3">Inscrir pour plus d'informations</span>
                       <button type="button" class="btn btn-outline-dark btn-rounded mx-3">
                         Sign up!
                       </button>
                     </p>
                   </section>
                   <!-- Section: Social media -->
                 <!-- Copyright -->
                 <div class="text-center text-dark p-3 " style="background-color: #f1f1f1;width: 100%;">
                   © 2021 Copyright

                 </div>
                 <!-- Copyright -->
               </div>
               </footer>
        </div>
@endsection




