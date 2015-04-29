<!-- Vote on post -->

<span class="ajax_test_name">Vote Post</span>
<form class="ajax_test_form" action="/post" method="post">  
  <input type="hidden" name="action" value="postVote"/>
  <div class="form-group">
    <label>Post Number</label>
    <input type="text" name="postId" class="form-control"/>
  </div>
  <input type="submit" name="direction" value="up" class="btn btn-default"/>
  <input type="submit" name="direction" value="down" class="btn btn-default"/>
</form>
