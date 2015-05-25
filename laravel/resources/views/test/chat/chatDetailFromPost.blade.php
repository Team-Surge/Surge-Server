<!-- Create yak (logged in)-->

<span class="ajax_test_name">Get Conversation by Post</span>
<form class="ajax_test_form" action="/chat" method="post">  
  <input type="hidden" name="action" value="chatDetail"/>
  <input type="hidden" name="fromType" value="post"/>
  <div class="form-group">
    <label>Post ID</label>
    <input type="text" name="fromId" class="form-control"/>
  </div>

  <button type="submit" class="btn btn-default">Get</button>
</form>


