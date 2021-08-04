<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="{{ asset('css/mystyle.css') }}" href="style.css">
        <title>Laravel</title>
        <script src="{{ asset('js/main.js') }}" defer></script>

        <style>

        </style>
    </head>

        <body onload="getcategorie()">

            @include('layouts.app')
            <div class="row container">
           <div class="col-2 text-center" style="border: 1px solid red" id="cat">

           </div>
           <div class="col-10">

           <div id="prods">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
{{--
                    @for ($i=0;$i<count($images);$i++)
                    @if ($i==0)
                  <div class="carousel-item active">
                  <img src="{{asset('/images/'. $images[$i]->image )}}" height="300px" width="123px" class="d-block mx-auto" alt="...">
                  </div>
                  @else
                  <div class="carousel-item ">
                  <img src="{{asset('/images/'. $images[$i]->image )}}" height="300px" width="123px" class="d-block mx- auto" alt="...">
                  </div>

                  @endif
                  @endfor --}}
                </div>
              </div>
            </div>
           </div>





    </body>
</html>
