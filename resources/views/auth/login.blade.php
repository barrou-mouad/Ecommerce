@extends('layouts.app')

@section('content')
<div class="mycontainer my-5 login">
    <div class="row bg-bluesky-bottom ">
        <div class="col-md-6 justify-content-end align-items-end">
      <img src="{{ asset('images/logo.png') }}" class="ml-5" height="300px">
        </div>
        <div class="col-md-6">
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-left"> {{ __('  Email    ') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-left ">{{ __('Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0 d-flex justify-content-start">
                            <div class="col-10">
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ __('Se connecter') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link mr-0" href="{{ route('password.request') }}">

                               {{ __('Vous avez oublié le mot de passe ? ') }}
                                    </a>
                                @endif
<div class="row justify-content-start align-items-center">

 <span class="ml-4">   {{ __('   Vous n\'avez pas de compte ?  ') }}  </span> <a href="" class="btn btn-success ml-4">
         {{ __('S\'inscrire') }}
    </a>
</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
