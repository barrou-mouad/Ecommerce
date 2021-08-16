@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">La liste des categories</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="myTable" class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>titre</th>
                            <th>image</th>
                            <th>prix</th>
                            <th>stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            @foreach ($produit as $item)


                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td><img height="80px" src="{{ asset('images/'.$item->image) }}"></td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->in_stock}}</td>
                            <td><a href="{{route('admin.deleteprod',$item->id)}}" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></a> <a href="{{route('admin.editprod',$item->id)}}" class="btn btn-success mx-2"><i class="fas fa-edit"></i></a><a href="{{route('admin.prodetails',$item->id)}}" class="btn btn-dark"><i class="fas fa-eye"></i></a></td>

                        </tr>
                        @endforeach
                        </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
            <a href="{{route('admin.prodadd')}}" class="btn btn-primary">ajouter </a>
        </div>

        <!-- /.card -->

    </section></div>

@endsection
