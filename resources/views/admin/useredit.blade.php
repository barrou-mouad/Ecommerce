@extends('admin.layout')
@section('content')
 <div class="content-wrapper">
<section class="content">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Modification de profil </div>
                <div class="card-body">
                 <form method="POST" action="{{route('admin.userupdate')}}">
                    @csrf
                  <div class="row  justify-content-center">
                      <div class="col-lg-4 col-md-6 col-sm-12 my-2"><label>Nom</label></div>
                      <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                          <input class="form-control  @error('name') is-invalid @enderror" name="name" value="{{$user->name}}">
                          @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                        </div>
                      <div class="col-lg-4 my-2 col-md-6 col-sm-12"><label>Email</label></div>
                      <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                          <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}">
                          @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                        </div>
                      <div class="col-lg-4 my-2 col-md-6 col-sm-12"><label>Telephone</label></div>
                      <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                          <input class="form-control  @error('number_phone') is-invalid @enderror" name="number_phone" value="{{$user->number_phone}}">
                          @error('number_phone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                        </div>
                      <div class="col-lg-4 my-2 col-md-6 col-sm-12"><label>Adresse</label></div>
                      <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                          <input class="form-control @error('address') is-invalid @enderror" name="address" value="{{$user->address}}">
                          @error('address')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                        </div>
                        <input type="hidden" name="id" value="{{$user->id}}">
                      <div class="col-lg-10 col-md-12 "> <input type="submit" value="Confirmer" class="btn btn-success" ></div>
                  </div>

                 </form>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@endsection
