
    <div id="msg" style="display: none" class="alert alert-success">
        Le produit est bien Ajouter au panier
       </div>

<div class="d-flex mr-2">
    @foreach ($produits as $produit)
  <div class="card" style="width: 15rem; height:200px">
  <img src="{{asset('/images/'. $produit->image )}}" height="225px" class="card-img-top" alt="...">
  <div class="card-body text-center">
    <h5 class="card-title">{{ $produit->title }}</h5>
    <p class="card-text"> Price: {{ $produit->price }} DH</p>
    <div class="d-flex  justify-content-center">
        <a href="/prd/1" class="btn btn-primary mr-2">Détails</a>
        <a class="btn btn-outline-danger" onclick="addtofavorite('/addcart/'+{{$produit->id}})"><i class="fas fa-heart"></i></a>
    </div>


  </div>
</div>
@endforeach
</div>
<div class="row" style="margin-top:  180px ">
    <div class="col-md-12 w-25 mx-auto">

    </div>
</div>

<input type="hidden" id="catID" value="{{$produits[0]->categorie_id}}">
<script>

</script>
