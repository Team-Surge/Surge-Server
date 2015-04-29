<!-- Create yak (logged in)-->

<span class="ajax_test_name">Create Post</span>
<form class="ajax_test_form" action="/post" method="post">  
  <input type="hidden" name="action" value="postCreate"/>
  <div class="form-group">
    <label>Handle</label>
    <input type="text" name="handle" class="form-control"/>
  </div>
  <div class="form-group">
    <label>Post</label>
    <textarea name="content" class="form-control"></textarea>
  </div>
  <button type="submit" class="btn btn-default">Post</button>
</form>

