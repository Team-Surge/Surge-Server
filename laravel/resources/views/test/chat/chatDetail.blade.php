<!-- Create yak (logged in)-->

<span class="ajax_test_name">Get Conversation</span>
<form class="ajax_test_form" action="/chat" method="post">  
  <input type="hidden" name="action" value="chatDetail"/>
  <div class="form-group">
    <label>Conversation ID</label>
    <input type="text" name="conversationId" class="form-control"/>
  </div>

  <button type="submit" class="btn btn-default">Get</button>
</form>


