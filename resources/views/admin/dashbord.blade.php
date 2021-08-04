@include('layouts.app')
<h1>Hello world</h1>
<form action="{{route('admin.logout')}}" method="post">
@csrf
<input type="submit" value="Logout">
</form>
