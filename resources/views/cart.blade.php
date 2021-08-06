@include('layouts.app')
<div class="table-responsive">
    <div class="container">
        <table class="table text-center table-bordered table-hover">
            <thead>
                <tr>
                <th>Image</th>
                <th>Nom Produit</th>
                <th>Quatité</th>
                <th>Prix</th>
                <th>Total</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                <td><img class="img-fluid" width="70px" src="{{asset('/images/'.$item->associatedModel->image )}}" class=""></td>
                <td>{{$item->name}}</td>
                <td> <form action="{{route('editcart')}}" method="post"> @csrf <input type="hidden" name="id" value="{{$item->id}}"> <input name="qty"  type="number" value="{{$item->quantity}}" min="1" max="{{$item->associatedModel->in_stock}}"><button type="submit" class="mx-2 my-2 btn btn-success">valider</button></form></td>
                <td>{{$item->price}}</td>
                <td>{{$item->price * $item->quantity}}</td>
                <td><a href="{{route('removefromcart',$item->id)}}" class="btn btn-outline-danger" ><i class="fas fa-trash-alt"></i></a></td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="text-left">
                <tr>
                    <td colspan="2" class="bg-secondary">Total</td>
                    <td colspan="2">{{\Cart::getSubTotal();}}</td>
                    <td>DH</td>
                </tr>
            </tfoot>
        </table>
        <a href="{{route('payer')}}" class="btn btn-info">Payer {{\Cart::getSubTotal();}} DH via PayPal <i class="fab fa-paypal"></i></a>
</div>
