<div class="row d-flex justify-content-between align-content-between mr-2">
    @foreach ($produits as $produit)
<div class="col-xl-3 col-md-6 col-sm-12 my-sm-2">
    <div class="card bg-light text-center mx-auto h-100" style="width: 14rem;min-height: 360px">
        <img src="{{asset('/images/'. $produit->image )}}" class="card-img-top bg-bluesky" width="50px" height="200px" alt="...">
        <div class="card-body bg-bluesky-bottom">
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
</div>
<div class="row" >
    <div class="col-md-12 w-25 d-flex justify-content-center mx-auto">
        {!! $produits->links() !!}
    </div>
</div>
