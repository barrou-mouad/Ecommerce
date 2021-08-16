@extends('layouts.app')

@section('content')
<div class="container">
   @if (Session::has('error'))


    <div class="alert alert-danger">
        {{Session::get('error')}}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Modification de mot de passe </div>
                <div class="card-body">
                 <form method="POST" action="{{route('user.updatepassword')}}">
                    @csrf
                  <div class="row  justify-content-center">
                      <div class="col-lg-4 col-md-6 col-sm-12 my-2"><label>Mot de passe actuel</label></div>
                      <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                     <input type="password" id="currrent_password" class="form-control  @error('current_password') is-invalid @enderror" name="current_password">
                     @error('current_password')
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                 @enderror
                    </div>
                      <div class="col-lg-4 my-2 col-md-6 col-sm-12"><label>Nouveau mot de passe</label></div>
                      <div class="col-lg-6 col-md-6 col-sm-12 my-2"><input type="password" id="new_password" class="form-control  @error('new_password') is-invalid @enderror " name="new_password">
                        @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                      <div class="col-lg-4 my-2 col-md-6 col-sm-12"><label>Confirmer mot de passe</label></div>
                      <div class="col-lg-6 col-md-6 col-sm-12 my-2"><input type="password" class="form-control  @error('confirm_password') is-invalid @enderror" name="confirm_password">
                        @error('confirm_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                      <div class="col-lg-10 col-md-12 "> <input type="submit" value="Confirmer" class="btn btn-success" ></div>
                  </div>

                 </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


