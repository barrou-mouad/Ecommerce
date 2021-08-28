@extends('layouts.app')

@section('content')
<div onload="selected()" class="mycontainer">

        <h2 class="title">Rechercher par prix et catégorie</h2>
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
    <div class="col-4"><input type="submit" class="btn btn-primary btn-block" value="Chercher" style="background-color: #B6C867 !important; "> </div>
        </div>
        </div>

    </div>
    </form>
    <!-- Search form end-->
                <div  class="row">
               <div class=" col-xl-2 col-lg-3 col-md-4 col-xs-12 text-center categorie p-0 " id="cat">
                <nav class='animated bounceInDown my-2'>
                    <ul class="cat">
                        <li><a href='#profile'>Profile</a></li>
                        <li><a href='#message'>Messages</a></li>
                        <li><a href='#message'>Logout</a></li>
                        <li><a href='#profile'>Profile</a></li>
                        <li><a href='#message'>Messages</a></li>
                        <li><a href='#message'>Logout</a></li>
                        <li><a href='#profile'>Profile</a></li>
                        <li><a href='#message'>Messages</a></li>
                        <li><a href='#message'>Logout</a></li>
                        <li><a href='#profile'>Profile</a></li>
                        <li><a href='#message'>Messages</a></li>
                        <li><a href='#message'>Logout</a></li>
                    </ul>
                </nav>
                </div>

               <div class="col-xl-10 col-lg-9 col-md-8 col-xs-12">

               <div id="prods">
                @if (app('request')->is('getproduits/*'))
                <input type="hidden" id="catID" value="{{app('request')->id}}">
                @else
                <input type="hidden" id="catID" value="0">
                @endif
                <div id="produit" class="favorite ">


<div class="row d-flex justify-content-between align-content-between mr-2">
                    @foreach ($produits as $produit)
                <div class="col-xl-3 col-md-6 col-sm-12 my-sm-2">
                    <div class="card bg-light text-center mx-auto h-100" style="width: 14rem;min-height: 360px">
                        <img src="{{asset('/images/'. $produit->image )}}" class="card-img-top" width="50px" height="200px" alt="...">
                        <div class="card-body">
                          <h5 class="card-title"> {{Str::limit($produit->title , 10,) }}</h5>
                          <p class="card-text"><del>$16.5</del> <span class="price">{{ $produit->price}}</span> </p>
                          <div class="show">
                            <a href="getproduit/{{ $produit->id }}" class="btn btn-light"><i class="fas fa-eye"></i></a>
                            <button class="btn btn-light my-3"><i class="fas fa-heart"></i></button>
                            <button class="btn btn-light"><i class="fas fa-shopping-cart"></i></button>
                          </div>

                        </div>
                      </div>
                    </div>
                @endforeach
                </div>      </div>
                <div class="row my-4" >
                    <div class="col-md-12 w-25 d-flex justify-content-center mx-auto">
                        {!! $produits->links() !!}
                    </div>
                </div>
                </div>
               </div>


            </div>

             <h2 class="title my-5">Promotion</h2>

    <div class="my-3 rounded-4 shadow" style="border-radius: 10px;background-color: #ef9273 !important;">
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
                        <img src="{{ asset('images/'.$produit->image)}}" style="height: 400px !important" class="" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <button class="btn btn-outline-primary">Détails</button>
                            <div class="mt">
                                <span class="bg-success px-3" style="font-size: 30px;font-weight: bolder">{{$produit->price}} DH</span>   <span class="bg-dark px-3 text-danger"  style="font-size: 30px"><strike>{{$produit->old_price}} DH</strike> </span>
                               </div>
                         <!-- <h5><span class="bg-warning px-3"> {{$produit->title}}</span> </h5>-->
                         <h5>{{$produit->title}}</h5>
                         <p>{{$produit->desc}}</p>
                        </div>
                    </div>
                    @else
                    <div class="carousel-item container">

                        <img src="{{ asset('images/'.$produit->image)}}" style="height: 400px !important"  class="" alt="...">
                        <div class="carousel-caption d-none d-md-block text-dark "  >

                            <h5 class="text-dark">{{$produit->title}}</h5>
                            <p class="text-dark">{{$produit->desc}}</p>
                            <button class="btn0 my-3 shadow">Détails</button>
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


                <h2 class="title" >Les produits les plus aimées</h2>



            <div class="owl-carousel favorite d-flex justify-content-between align-content-center">

                @foreach ($favorites as $favorite)

                <div class="col-3">
                <div class="card bg-light text-center mx-auto h-100" style="width: 14rem;min-height: 360px">
                    <img src="{{asset('/images/'. $favorite->image )}}" class="card-img-top" width="50px" height="200px" alt="...">
                    <div class="card-body">
                      <h5 class="card-title"> {{Str::limit($favorite->title , 10,) }}</h5>
                      <p class="card-text"><del>$16.5</del> <span class="price">{{ $favorite->price}}</span> </p>
                      <div class="show">
                        <a href="getproduit/{{ $favorite->id }}" class="btn btn-light"><i class="fas fa-eye"></i></a>
                        <button class="btn btn-light my-3"><i class="fas fa-heart"></i></button>
                        <button class="btn btn-light"><i class="fas fa-shopping-cart"></i></button>
                      </div>

                    </div>
                  </div>
                </div>
              @endforeach

            </div>
            <div class="col-4">

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




