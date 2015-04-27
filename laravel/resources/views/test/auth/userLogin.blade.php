<!-- User Login -->

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

