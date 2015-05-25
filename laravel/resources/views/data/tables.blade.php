@extends('data.data')

@section('dataTable')

<table class="table table-striped table-bordered">
<col>
<col>
<tr>
<th>Table</th>
<th>Empty</th>
</tr>

@foreach(['posts' => 'Posts', 'users' => 'Users', 'votes' => 'Votes', 'comments' => 'Comments', 'conversation_user' => 'convo pivot', 'conversations' => 'Conversations', 'messages' => 'Messages'] as $key => $name)

<tr>
<td>
{{$name}}
</td>
<td>
<form action="/data/tables/{{$key}}" method="POST">
    <input type="hidden" name="action" value="empty"/>
    <button type="submit" class="btn btn-danger">Empty</button>
</form>
</td>
</tr>

@endforeach

</table>

@endsection
