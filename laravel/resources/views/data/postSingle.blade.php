@extends('data.data')

@section('dataTable')

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

@endsection
