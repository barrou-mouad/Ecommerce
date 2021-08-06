<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="{{ asset('css/mystyle.css') }}" href="style.css">
        <title>Laravel</title>
        <script src="{{ asset('js/main.js') }}" defer></script>

        <style>
        .cat {
        text-align: center;
        font-family: 'Karla', sans-serif;
        font-size: 20px;
        font-weight: 200;

        /*  transition: background-color 1s; */
        }

        .cat:hover {
            background-color: aqua;


            cursor: pointer;
            font-family: 'Karla', sans-serif;
        }
        .selected{
            background-color: orangered !important;


            cursor: pointer;
            font-family: 'Karla', sans-serif;
        }
        .selected:hover{
            background-color: orangered !important;

            cursor: pointer;
            font-family: 'Karla', sans-serif;
        }
        </style>
    </head>

        <body onload="selected()">

            @include('layouts.app')
            <div class="container">
            <div  class="row">
           <div class="col-xl-2 col-lg-3 col-md-4 col-xs-12 text-center" style="border: 1px solid red" id="cat">
            <div class="list-group">
            <a class="list-group-item list-group-item-action d-block w-100 cat  @if (app('request')->is('/')) active @endif">latest</a>
            @foreach ($categories as $categorie)
            <a id="{{$categorie->id}}" href="{{ route('getProdByCat',$categorie->id) }}" class="list-group-item list-group-item-action cat ">{{$categorie->title}}</a>
            @endforeach
            </div>
           </div>
           <div class="col-xl-10 col-lg-9 col-md-8 col-xs-12">

           <div id="prods">
            <div class="d-flex justify-content-center align-content-between mr-2">

            @if (app('request')->is('getproduits/*'))
            <input type="hidden" id="catID" value="{{app('request')->id}}">
            @else
            <input type="hidden" id="catID" value="0">
            @endif

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
            <div class="row" style="margin-top:  190px ">
                <div class="col-md-12 w-25 d-flex justify-content-center mx-auto">
                    {!! $produits->links() !!}
                </div>
            </div>
            </div>
           </div>


        </div>

    </body>
</html>
