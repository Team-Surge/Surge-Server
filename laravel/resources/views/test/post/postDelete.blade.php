<!-- Delete yak (logged in)-->

<span class="ajax_test_name">Delete Post</span>
<form class="ajax_test_form" action="/post" method="post">  
  <input type="hidden" name="action" value="postDelete"/>
  <div class="form-group">
    <label>Post Number</label>
    <input type="text" name="postId" class="form-control"/>
  </div>
  <button type="submit" class="btn btn-default">Delete</button>
</form>

