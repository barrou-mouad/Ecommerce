@include('layouts.app')
<div class="container">
    @if ( (Session::has('success')))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{Session::get('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    <form action="{{route('send')}}" method="post">
    @csrf
    <label>Email</label>
    <input type="email" name="email" class="form-control">
    <label>Objet</label>
    <input type="text" name="subject" class="form-control">
    <label>Message</label>
    <textarea name="body" class="form-control" rows="5"></textarea>
    <input type="submit" class="btn btn-primary my-1" value="Envoyer" style="background: #B6C867 !important;">
</form>
</div>
