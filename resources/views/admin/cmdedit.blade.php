@extends('admin.layout')
@section('content')
<div class="content-wrapper">
<form class="w-50 mx-auto" action="{{route('admin.cmdupdate')}}" method="post">
@csrf
<label>Quantité</label>
<input type="number" value="{{$cmd->qty}}" max="{{$cmd->produit->in_stock}}" min="1"  name="qty" class="form-control">
<label>Date de laivraison</label>
<input type="datetime" value="{{$cmd->delivery_date}}" name="delivery_date" class="form-control">
<input type="hidden" value="{{$cmd->id}}" name="id">
<input type="submit" class="btn btn-primary my-2">
</form>
</div>
@endsection
