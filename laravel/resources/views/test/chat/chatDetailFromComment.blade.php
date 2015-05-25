<!-- Create yak (logged in)-->

<span class="ajax_test_name">Get Conversation by Comment</span>
<form class="ajax_test_form" action="/chat" method="post">  
  <input type="hidden" name="action" value="chatDetail"/>
  <input type="hidden" name="fromType" value="comment"/>
  <div class="form-group">
    <label>Comment ID</label>
    <input type="text" name="fromId" class="form-control"/>
  </div>

  <button type="submit" class="btn btn-default">Get</button>
</form>


