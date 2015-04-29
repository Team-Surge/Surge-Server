@extends('data.data')

@section('dataTable')

<table class="table table-striped table-bordered">
<col>
<col style="width:100%">
<col>
<col>
<tr>
<th>ID</th>
<th>Email</th>
<th>Login</th>
<th>Delete</th>
@foreach($users as $i => $user)
</tr>
<tr>
<td>
{{$user->id}}
</td>
<td>
{{$user->email}}
</td>
<td>
<a class="btn btn-default" href="/data/users/{{$user->id}}">Login</a>
</td>
<td>
<form action="/data/users/{{$user->id}}" method="POST">
    <input type="hidden" name="_method" value="DELETE"/>
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
</td>
</tr>

@endforeach
</table>

@endsection
