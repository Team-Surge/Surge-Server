@extends('data.data')

@section('dataTable')

<h3>Conversation</h3>

<table class="table table-striped table-bordered">

<tr>
<th>
ID
</th>
<td>
{{$conversation->id}}
</td>
</tr>

<tr>
<th>
Subject
</th>
<td>
{{$conversation->subject}}
</td>
</tr>

<tr>
<th>
Delete
</th>
<td>
<form action="/data/conversations/{{$conversation->id}}" method="POST">
    <input type="hidden" name="_method" value="DELETE"/>
    <button type="submit" class="btn btn-danger pull-right">Delete</button>
</form>
</td>
</tr>

</table>

<h3>Messages</h3>

<table class="table table-striped table-bordered">
<tr>
<th>
ID
</th>
<th>
TID
</th>
<th>
Content
</th>
</tr>
@foreach($conversation->messages as $message)

<tr>
<td>
{{$message->id}}
</td>
<td>
{{$message->tid}}
</td>
<td>
{{$message->content}}
</td>
</tr>

@endforeach
</table>


@endsection
