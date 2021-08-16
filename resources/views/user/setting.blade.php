@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('success'))


    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Paramètre </div>

                <div class="card-body">
                    <div class="list-group">
                        <a href="{{route('user.edit')}}" class="list-group-item list-group-item-action"><i class="fas fa-user-edit"></i> Information personnelle</a>
                        <a href="{{route('user.editpassword')}}" class="list-group-item list-group-item-action"><i class="fas fa-key"></i> Mot de passe</a>


                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
