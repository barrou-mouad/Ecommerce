@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <form action="{{route('admin.addprod')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
    <div class="col-6">
    <label>Titre</label>
    <input name="title" value="" class="form-control">
    <label>Prix</label>
    <input name="price" value="" class="form-control">
    <label>Stock</label>
    <input name="in_stock" value="" class="form-control">
    <label>Categorie</label>
    <select class="form-select" name="categorie_id" id="">
    @foreach ($categories as $categorie)
    <option value="{{$categorie->id}}">{{$categorie->title}}</option>
    @endforeach
    </select>
    <label>Descreption</label>
    <input name="desc" value="" class="form-control">
    </div>
    <div class="col-6">
    <img class="d-block mx-auto" id="preview-image-before-upload" height="280px" src="{{ asset('images/icons/iconmonstr-product-3-240.png')}}">
    <label>Image</label>
    <input type="file" id="image" name="img"  class="form-control">


    </div>
    <input type="submit" class="btn btn-block btn-primary my-3">
</div>
</form>
</section></div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
$(document).ready(function (e) {


 $('#image').change(function(){

  let reader = new FileReader();

  reader.onload = (e) => {

    $('#preview-image-before-upload').attr('src', e.target.result);
  }

  reader.readAsDataURL(this.files[0]);

 });

});

</script>
@endsection
