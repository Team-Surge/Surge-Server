<!-- Vote on post -->

<span class="ajax_test_name">Respond Poll</span>
<form class="ajax_test_form" action="/post" method="post">  
  <input type="hidden" name="action" value="postPollRespond"/>
  <div class="form-group">
    <label>Post Number</label>
    <input type="text" name="postId" class="form-control"/>
  </div>
  <div class="form-group">
    <label>Selection</label> 
    <input type="text" name="selection" class="form-control"/>
  </div>
  <button type="submit" class="btn btn-default"/>Respond</button>
</form>
