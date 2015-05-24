<!-- Create chat (logged in)-->

<span class="ajax_test_name">Create Chat (comment)</span>
<form class="ajax_test_form" action="/chat" method="post">  
  <input type="hidden" name="action" value="chatCreate"/>
  <input type="hidden" name="fromType" value="comment"/>
  <div class="form-group">
    <label>Comment Id</label>
    <input type="text" name="fromId" class="form-control"/>
  </div>
  
  <button type="submit" class="btn btn-default">Chat</button>
</form>


