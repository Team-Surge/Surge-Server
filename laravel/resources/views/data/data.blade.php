@extends('main')

@section('content')
    <div class="container">  
    <br/>
      <div class="row">
        <div class="col-sm-3">
        
          <div class="panel panel-default">
            <div class="panel-body">
              <ul class="nav nav-pills nav-stacked">
                <li role="presentation"><a href="/data/users">Users</a></li>
                <li role="presentation"><a href="/data/posts">Posts</a></li>
              </ul>
            </div>
          </div>

        
        </div>
        <div class="col-sm-9">
        
        @yield('dataTable')
        
        </div>
      </div>

    </div><!-- /.container -->
@endsection
