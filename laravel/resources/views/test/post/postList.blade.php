<!-- Delete yak (logged in)-->

<span class="ajax_test_name">List Posts</span>
<form class="ajax_test_form" action="/post" method="post">  
  <input type="hidden" name="action" value="postList"/>
  
  <div class="form-group">
    <label>Lat</label>
    <input id="mapLat_list" name="lat" class="form-control"/>
  </div>
  
  <div class="form-group">
    <label>Lng</label>
    <input id="mapLng_list" name="lng" class="form-control"/>
  </div>
  
  <button class="postMapLoad btn btn-default" data-for="list">Map</button>
  <button type="submit" class="btn btn-default">List</button>
</form>

