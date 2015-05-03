<!-- Create yak (logged in)-->

<span class="ajax_test_name">Create Comment</span>
<form class="ajax_test_form" action="/post" method="post">  
  <input type="hidden" name="action" value="postCreateComment"/>
  <div class="form-group">
    <label>Post Number</label>
    <input type="text" name="postId" class="form-control"/>
  </div>
  <div class="form-group">
    <label>Post</label>
    <textarea name="content" class="form-control"></textarea>
  </div>
  <button type="submit" class="btn btn-default">Post</button>
</form>

