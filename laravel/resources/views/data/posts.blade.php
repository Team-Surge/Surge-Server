@extends('data.data')

@section('dataTable')

<table class="table table-striped table-bordered">
<col>
<col>
<col>
<col style="width:100%">
<col>
<col>
<tr>
<th>ID</th>
<th>User</th>
<th>Parent</th>
<th>content</th>
<th>Show</th>
<th>Delete</th>
@foreach($posts as $i => $post)
</tr>
<tr>
<td>
{{$post->id}}
</td>
<td>
{{$post->user_id}}
</td>
<td>
{{$post->parent}}
</td>
<td>
{{$post->content}}
</td>
<td>
<a class="btn btn-default" href="/data/posts/{{$post->id}}">Show</a>
</td>
<td>
<form action="/data/posts/{{$post->id}}" method="POST">
    <input type="hidden" name="_method" value="DELETE"/>
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
</td>
</tr>

@endforeach
</table>

@endsection
