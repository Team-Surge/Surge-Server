@extends('main')

@section('content')
    <div class="container">  
    <br/>
      <div class="row">
        <div class="col-sm-3">
        
          <div class="panel panel-default">
            <div class="panel-body">
              <ul class="nav nav-pills nav-stacked">
              
                <?php
                  
                  $pages = [];
                  $pages[] = ['id' => 'users', 'name' => 'Users'];
                  $pages[] = ['id' => 'posts', 'name' => 'Posts'];
                                    
                ?>
              
                @foreach($pages as $page)
                <li role="presentation" class="{{($page['id'] == $pageid) ? "active" : ""}}"><a href="/data/{{$page['id']}}">{{$page['name']}}</a></li>
                @endforeach
              </ul>
            </div>
          </div>

        
        </div>
        <div class="col-sm-9">
        
        
        @if (Session::has('message'))

        <div class="alert alert-{{Session::get('message')['type']}} alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{Session::get('message')['message']}}
        </div>
        
        @endif
        
        @yield('dataTable')
        
        </div>
      </div>

    </div><!-- /.container -->
@endsection
