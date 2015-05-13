<!-- Vote on post -->

<span class="ajax_test_name">Vote Comment</span>
<form class="ajax_test_form" action="/post" method="post">  
  <input type="hidden" name="action" value="postCommentVote"/>
  <div class="form-group">
    <label>Comment Number</label>
    <input type="text" name="commentId" class="form-control"/>
  </div>
  <input type="submit" name="direction" value="up" class="btn btn-default"/>
  <input type="submit" name="direction" value="neutral" class="btn btn-default"/>
  <input type="submit" name="direction" value="down" class="btn btn-default"/>
</form>
