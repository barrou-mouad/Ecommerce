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
                    <th>action</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    @foreach ($cat as $item)


                    <td>{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td><a href="{{route('admin.deletecat',$item->id)}}" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></a> <a href="{{route('admin.editcat',$item->id)}}" class="btn btn-success"><i class="fas fa-edit"></i></a></td>

                </tr>
                @endforeach
                </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Ajouter
  </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ajouter categorie</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.addcat')}}" method="post">
        @csrf
        <div class="modal-body">
        <label>Le titre</label>
        <input type="text" name="title" class="form-control">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Confirmer</button>
        </div>
    </form>
      </div>
    </div>
  </div>

</section>
</div>
@endsection
