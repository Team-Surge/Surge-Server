<!-- Create yak (logged in)-->

<span class="ajax_test_name">Create Message</span>
<form class="ajax_test_form" action="/chat" method="post">  
  <input type="hidden" name="action" value="chatSend"/>
  <div class="form-group">
    <label>Conversation ID</label>
    <input type="text" name="conversationId" class="form-control"/>
  </div>
  
  <div class="form-group">
    <label>Message</label>
    <input type="text" name="content" class="form-control"/>
  </div>

  <button type="submit" class="btn btn-default">Post</button>
</form>


