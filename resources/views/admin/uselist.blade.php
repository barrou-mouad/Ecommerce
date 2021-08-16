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
                            <th>name</th>
                            <th>email</th>
                            <th>adresse</th>
                            <th>telephone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            @foreach ($user as $item)


                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->address}}</td>
                            <td>{{$item->number_phone}}</td>
                            <td><a href="{{route('admin.userdelete',$item->id)}}" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></a> <a href="{{route('admin.useredit',$item->id)}}" class="btn btn-success mx-2"><i class="fas fa-edit"></i></a></td>

                        </tr>
                        @endforeach
                        </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
            <a href="{{route('admin.useradd')}}" class="btn btn-primary">ajouter </a>
        </div>

        <!-- /.card -->

    </section></div>

@endsection
