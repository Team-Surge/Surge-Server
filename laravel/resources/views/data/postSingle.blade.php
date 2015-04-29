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
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
</td>
</tr>

</table>

<h3>Votes</h3>

<table class="table table-striped table-bordered">
<tr>
<th>
Post ID
</th>
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
{{$vote->post_id}}
</td>
<td>
{{$vote->user_id}}
</td>
<td>
{{$vote->vote}}
</td>
</tr>

@endforeach
</table>
@endsection
