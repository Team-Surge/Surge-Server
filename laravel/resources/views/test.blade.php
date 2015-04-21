@extends('main')

@section('content')
    <div class="container"> 
    <br/>   
      <div class="row">
        <div class="col-sm-6">
         <div class="scrollable" id="testScroller">
            <!-- Login -->
            <div class="ajax_test_group">
              <div class="ajax_test_block">
              <span class="ajax_test_name">Login</span>
              <form class="ajax_test_form" action="/auth" method="post">  
                <input type="hidden" name="action" value="userLogin"/>
                <div class="form-group">
                  <label>Email address</label>
                  <input type="text" class="form-control" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
              </form>
            </div>
            
            <!-- Create User-->
            <div class="ajax_test_block">
              <span class="ajax_test_name">Create User</span>
              <form class="ajax_test_form" action="/auth" method="post">  
                <input type="hidden" name="action" value="userCreate"/>
                <div class="form-group">
                  <label>Email address</label>
                  <input type="text" class="form-control" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-default">Create Me</button>
              </form>
            </div>
            
            <!-- Delete User (logged in)-->
            <div class="ajax_test_block">
              <span class="ajax_test_name">Deleted logged in user</span>
              <form class="ajax_test_form" action="/auth" method="post">  
              <input type="hidden" name="action" value="userDelete"/>
                <button type="submit" class="btn btn-default">Delete Me</button>
              </form>
            </div>

          
            <!-- Create yak (logged in)-->
            <div class="ajax_test_block">
              <span class="ajax_test_name">Create Yak</span>
              <form class="ajax_test_form" action="/auth" method="post">  
                <input type="hidden" name="action" value="yakCreate"/>
                <div class="form-group">
                  <label>Post</label>
                  <textarea name="content" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-default">Post</button>
              </form>
            </div>

          
            <!-- Delete yak (logged in)-->
            <div class="ajax_test_block">
              <span class="ajax_test_name">Delete Yak</span>
              <form class="ajax_test_form" action="/auth" method="post">  
                <input type="hidden" name="action" value="yakDelete"/>
                <div class="form-group">
                  <label>Post Number</label>
                  <input type="text" name="yakID" class="form-control"/>
                </div>
                <button type="submit" class="btn btn-default">Delete</button>
              </form>
            </div>     
            
                      
            <!-- unknown action on auth -->
            <div class="ajax_test_block">
              <span class="ajax_test_name">Bad action on auth</span>
              <form class="ajax_test_form" action="/auth" method="post">  
                <input type="hidden" name="action" value="bogusAction"/>
                <button type="submit" class="btn btn-default">Bogus</button>
              </form>
            </div>       

          </div>
          <!-- end test group -->
        </div>
        <!-- End scrollable-->
        </div>
        <div class="col-sm-6">
          <div class="heading_center">Query</div>
          <div class="ajax_test_url" id="ajaxTestUrl"></div>
          <pre class="ajax_test_query" id="ajaxTestQuery">
        
          </pre>
          <div class="heading_center">Result</div>
          <pre class="ajax_test_result" id="ajaxTestResult">
        
          </pre>
        </div>
      </div>

    </div><!-- /.container -->
@endsection
