<!-- Vote on post -->

<span class="ajax_test_name">Vote Yak</span>
<form class="ajax_test_form" action="/post" method="post">  
  <input type="hidden" name="action" value="yakDelete"/>
  <div class="form-group">
    <label>Post Number</label>
    <input type="text" name="yakID" class="form-control"/>
  </div>
  <input type="submit" name="dir" value="up" class="btn btn-default"/>
  <input type="submit" name="dir" value="down" class="btn btn-default"/>
</form>
