@extends('layouts.app')

@section('content')
<div class="table-responsive" onload=" $('#myTable').DataTable();">
    <div class="container">
        <table id="myTable" class="table text-center table-bordered table-hover align-middle">
            <tr>
                <th>date</th>
                <th>titre</th>
                <th>image</th>
                <th>qty</th>
                <th>Date de laivraison</th>
                <th>total</th>
            </tr>
            @foreach ( auth::user()->commandes as $commande)
            <tr>
                <th class="align-middle">{{$commande->created_at}}</th>
                <th class="align-middle">{{$commande->produit->title}}</th>
                <th><img src="{{ asset('images/'.$commande->produit->image) }}  "  height="80px"></th>

                <th class="align-middle">{{$commande->qty}}</th>
                <th class="align-middle">
                @if ($commande->delivery_date) {{$commande->delivery_date}}
                @else <span class="text-danger">Pas Encore</span>
                @endif
               </th>
                <th class="align-middle">{{$commande->total}} DH</th>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>

    $('#myTable').DataTable();

</script>
@endsection
