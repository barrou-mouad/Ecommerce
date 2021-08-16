@extends('admin.layout')
@section('content')
<div class="content-wrapper">
<section class="content">
<form action="{{route('admin.catupdate')}}" method="post" class="w-50 mx-auto">
@csrf
<label>Titre</label>
<input class="form-control" value="{{$cat->title}}" name="title">
<input type="hidden"  value="{{$cat->id}}" name="id">
<input type="submit" value="confirmer" class="btn btn-primary my-2" >
</form>
</section>
</div>
@endsection
