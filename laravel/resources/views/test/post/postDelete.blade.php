<!-- Delete yak (logged in)-->

<span class="ajax_test_name">Delete Yak</span>
<form class="ajax_test_form" action="/post" method="post">  
  <input type="hidden" name="action" value="yakDelete"/>
  <div class="form-group">
    <label>Post Number</label>
    <input type="text" name="yakID" class="form-control"/>
  </div>
  <button type="submit" class="btn btn-default">Delete</button>
</form>

