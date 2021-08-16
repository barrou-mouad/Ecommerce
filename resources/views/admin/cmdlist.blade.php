@extends('admin.layout')
@section('content')
<div class="content-wrapper">
<div class="p-2">
    <h2 class="text-center">La liste des commandes sans date de laivraison</h2>
    <hr>
</div>
    <div class="table-responsive">
    <div class="card-body">
        <table id="myTable" class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>date</th>
                    <th>Nom client</th>
                    <th>Image</th>
                    <th>Produit</th>
                    <th>qty</th>
                    <th>Date de Livraison</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>


                    @foreach ($cmd as $item)
                    <tr>

                    <td>{{$item->created_at}}</td>
                    <td>{{$item->user->name}}</td>
                    <td><img height="50px" src="{{ asset('images/'.$item->produit->image)}}"></td>
                    <td>{{$item->produit->title}}</td>
                    <td>{{$item->qty}}</td>
                    <td ><form method="POST" action="{{route('admin.add_date')}}" class="d-flex flex-row justify-content-center align-items-center">@csrf<input type="datetime-local" name="delivery_date"><input type="hidden" name="id" value="{{$item->id}}"><input type="submit" value="OK" class="ml-1 btn btn-primary"></form></td>
                    <td class="d-flex flex-row justify-content-center align-items-center"><a href="{{route('admin.deletecmd',$item->id)}}" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></a> <a href="{{route('admin.cmdedit',$item->id)}}" class="btn btn-success mx-2"><i class="fas fa-edit"></i></a></td>

                </tr>
                @endforeach
                </tfoot>
        </table>
    </div>    </div>
    <!-- /.card-body -->
    <div class="p-2">
        <h2 class="text-center">La liste des commandes avec date de laivraison</h2>
        <hr>
    </div>
<div class="">
    <div class="card-body">
        <table id="myTable1" class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>date</th>
                    <th>Nom client</th>
                    <th>Image</th>
                    <th>Produit</th>
                    <th>qty</th>
                    <th>Date de Livraison</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>


                    @foreach ($commande as $item)
                    <tr>

                    <td>{{$item->created_at}}</td>
                    <td>{{$item->user->name}}</td>
                    <td><img height="70px" src="{{ asset('images/'.$item->produit->image)}}"></td>
                    <td>{{$item->produit->title}}</td>
                    <td>{{$item->qty}}</td>
                    <td>{{$item->delivery_date}}</td>
                    <td class="d-flex flex-row justify-content-center align-items-center"><a href="{{route('admin.deletecmd',$item->id)}}" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></a> <a href="{{route('admin.cmdedit',$item->id)}}" class="btn btn-success mx-2"><i class="fas fa-edit"></i></a></td>

                </tr>
                @endforeach
                </tfoot>
        </table>
    </div>
</div></div>
@endsection
