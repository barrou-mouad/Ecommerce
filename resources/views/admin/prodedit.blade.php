@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <form action="{{route('admin.produpdate')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
    <div class="col-6">
    <label>Titre</label>
    <input name="title" value="{{$produit->title}}" class="form-control">
    <label>Prix</label>
    <input name="price" value="{{$produit->price}}" class="form-control">
    <label>Ancien prix</label>
    <input value="{{$produit->old_price}}" class="form-control">
    <label>Categorie</label>
    <select class="form-control" name="categorie_id" id="">
    @foreach ($categories as $categorie)
    <option value="{{$categorie->id}}" @if($categorie->id==$produit->categorie_id) selected @endif>{{$categorie->title}}</option>
    @endforeach
    </select>
    <label>Descreption</label>
    <input name="desc" value="{{$produit->desc}}" class="form-control">
    <label>Stock</label>
    <input name="in_stock" value="{{$produit->in_stock}}" class="form-control">
    </div>
    <div class="col-6">
    <img class="d-block mx-auto" id="preview-image-before-upload" height="280px" src="{{ asset('images/'.$produit->image) }}">
    <label>Nouveau image</label>
    <input type="file" id="image" name="img"  class="form-control">
    <input type="hidden" name="id" value="{{$produit->id}}">

    </div>
    <input type="submit" class="btn btn-block btn-primary my-3">
</div>
</form>
</section></div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
$(document).ready(function (e) {


 $('#image').change(function(){
    console.log('hh')
  let reader = new FileReader();

  reader.onload = (e) => {

    $('#preview-image-before-upload').attr('src', e.target.result);
  }

  reader.readAsDataURL(this.files[0]);

 });

});

</script>
@endsection
