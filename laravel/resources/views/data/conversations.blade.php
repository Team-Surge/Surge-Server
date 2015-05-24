@extends('data.data')

@section('dataTable')

<table class="table table-striped table-bordered">
<tr>
<th>ID</th>
<th>Subject</th>
<th>show</th>
<th>delete</th>
@foreach($conversations as $i => $convo)
</tr>
<tr>
<td>
{{$convo->id}}
</td>
<td>
{{$convo->subject}}
</td>
<td>
<a class="btn btn-default" href="/data/conversations/{{$convo->id}}">Show</a>
</td>
<td>
<form action="/data/conversations/{{$convo->id}}" method="POST">
    <input type="hidden" name="_method" value="DELETE"/>
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
</td>
</tr>

@endforeach
</table>

@endsection
