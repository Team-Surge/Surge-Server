@extends('data.data')

@section('dataTable')

<h3>Post</h3>

<table class="table table-striped table-bordered">

<tr>
<th>
Post ID
</th>
<td>
{{$post->id}}
</td>
</tr>

<tr>
<th>
User ID
</th>
<td>
{{$post->user_id}}
</td>
</tr>

<tr>
<th>
Parent
</th>
<td>

{{$post->parent}}

@if($post->parent != null)

<a class="btn btn-default pull-right" href="/data/posts/{{$post->parent}}">Show</a>

@endif

</td>
</tr>

<tr>
<th>
Handle
</th>
<td>
{{$post->handle}}
</td>
</tr>


<tr>
<th>
Content
</th>
<td>
{{$post->content}}
</td>
</tr>

<tr>
<th>
Delete
</th>
<td>
<form action="/data/posts/{{$post->id}}" method="POST">
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
@foreach($post->votes as $vote)

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

<h3>Comments</h3>

<table class="table table-striped table-bordered">
<col>
<col>
<col>
<col style="width:100%">
<tr>
<th>ID</th>
<th>User</th>
<th>content</th>
@foreach($post->comments as $i => $comment)
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
</tr>

@endforeach
</table>

@endsection
