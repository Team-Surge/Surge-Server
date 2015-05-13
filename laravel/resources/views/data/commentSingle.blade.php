@extends('data.data')

@section('dataTable')

<h3>Comment</h3>

<table class="table table-striped table-bordered">

<tr>
<th>
Post ID
</th>
<td>
{{$comment->id}}
</td>
</tr>

<tr>
<th>
User ID
</th>
<td>
{{$comment->user_id}}
</td>
</tr>

<tr>
<th>
Parent
</th>
<td>

{{$comment->post_id}}

<a class="btn btn-default pull-right" href="/data/posts/{{$comment->post_id}}">Show</a>

</td>
</tr>


<tr>
<th>
Content
</th>
<td>
{{$comment->content}}
</td>
</tr>

<tr>
<th>
Delete
</th>
<td>
<form action="/data/comments/{{$comment->id}}" method="POST">
    <input type="hidden" name="_method" value="DELETE"/>
    <button type="submit" class="btn btn-danger pull-right">Delete</button>
</form>
</td>
</tr>

</table>

<h3>Votes</h3>

<table class="table table-striped table-bordered">
<tr>
<th>
User ID
</th>
<th>
Value
</th>
</tr>
@foreach($comment->votes as $vote)

<tr>
<td>
{{$vote->user_id}}
</td>
<td>
{{$vote->value}}
</td>
</tr>

@endforeach
</table>

@endsection
