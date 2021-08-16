@extends('admin.layout')
@section('content')

<section class="content">
<div class="content-wrapper">
<div class="row d-flex justify-content-center">
    <div class=" col-lg-7 col-sm-12">
        <div class="card mx-auto" style="width: 30rem;">
            <h5 class="card-header">{{$produit->title}}</h5>
            <img src="{{asset('/images/'. $produit->image )}}" width="100px" height="340px" class="card-img-top" alt="...">
            <div class="card-body">

                   <p class="card-text" style="font-size: 25px"><b>prix : </b> {{$produit->price}} DH</dipv>
                    @if($produit->old_price>0) <p class="card-text" style="font-size:20px "><b>Ancien prix : </b>  {{$produit->old_price}} DH</p> @endif
              <p class="card-text" style="font-size: 20px"><b>Categorie : </b>{{$produit->categorie->title}}</p>
              <p class="card-text" style="font-size: 20px"><b>Description : </b>{{$produit->desc}}</p>
              <p class="card-text" style="font-size: 20px"><b>Aimée par  : </b>{{count($produit->likes) }}</p>
              <p class="card-text" style="font-size: 20px"><b>commandée par : </b>{{count( $produit->commandes)}}</p>
            </div>
            <div class="card-footer mx-auto">
                <a href="{{route('admin.deletecat',$produit->id)}}" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></a> <a href="{{route('admin.editcat',$produit->id)}}" class="btn btn-success mx-2"><i class="fas fa-edit"></i></a>
            </div>
          </div>
    </div>
</div>
</section>
</div>
@endsection
