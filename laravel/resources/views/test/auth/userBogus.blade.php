<!-- unknown action on auth -->

<span class="ajax_test_name">Bad action on auth</span>
<form class="ajax_test_form" action="/auth" method="post">  
  <input type="hidden" name="action" value="bogusAction"/>
  <button type="submit" class="btn btn-default">Bogus</button>
</form>

