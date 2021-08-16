@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="p-2">
            <hr>
            <h2 class="text-center">Revenu Mensuel</h2>
            <hr>
        </div>
            <div class="card">
            <div class="card-header">
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="myTable" class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>Année</th>
                            <th>Mois</th>
                            <th>Somme</th>

                        </tr>
                    </thead>
                    <tbody>


                            @foreach ($sum as $item)
                            <tr>

                            <td>{{$item->year}}</td>
                            <td>{{$item->month}}</td>
                            <td>{{$item->somme}} DH</td>


                        </tr>
                        @endforeach
                        </tfoot>
                </table>
            </div>
        </div>
        <div class="p-2">
            <hr>
            <h2 class="text-center">5 produits plus commandées</h2>
            <hr>
        </div>
        <div class="card">
            <div class="card-header">
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="myTable1" class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>Nombre commande</th>
                            <th>titre</th>
                            <th>image</th>
                            <th>quantité stock</th>

                        </tr>
                    </thead>
                    <tbody>


                            @foreach ($prods as $item)
                            <tr>
                                <td>{{$item->nmbr}}</td>
                            <td>{{$item->title}}</td>
                            <td><img height="50px" src="{{ asset('images/'.$item->image) }}">
                            <td>{{$item->in_stock}}</td>


                        </tr>
                        @endforeach
                        </tfoot>
                </table>
            </div>
        </div>
    </section>

</div>
@endsection
