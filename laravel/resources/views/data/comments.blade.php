@extends('data.data')

@section('dataTable')

<table class="table table-striped table-bordered">
<col>
<col>
<col style="width:100%">
<col>
<col>
<tr>
<th>ID</th>
<th>User</th>
<th>content</th>
<th>Show</th>
<th>Delete</th>
@foreach($comments as $i => $comment)
</tr>
<tr>
<td>
{{$comment->id}}
</td>
<td>
{{$comment->user_id}}
</td>
<td>
{{$comment->content}}
</td>
<td>
<a class="btn btn-default" href="/data/comments/{{$comment->id}}">Show</a>
</td>
<td>
<form action="/data/comments/{{$comment->id}}" method="POST">
    <input type="hidden" name="_method" value="DELETE"/>
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
</td>
</tr>

@endforeach
</table>

@endsection
