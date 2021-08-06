@include('layouts.app')
<div class="container">
    <form action="" method="post">
    @csrf
    <label>Email</label>
    <input type="email" name="email" class="form-control">
    <label>Objet</label>
    <input type="email" name="title" class="form-control">
    <label>Message</label>
    <textarea name="body" class="form-control" rows="5"></textarea>
    <input type="submit" class="btn btn-primary my-1" value="Envoyer">
</form>
</div>
