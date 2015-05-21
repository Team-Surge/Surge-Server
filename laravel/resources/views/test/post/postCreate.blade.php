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
  
  <div class="form-group">
    <label>Lat</label>
    <input id="mapLat_post" name="lat" class="form-control"/>
  </div>
  
  <div class="form-group">
    <label>Lng</label>
    <input id="mapLng_post" name="lng" class="form-control"/>
  </div>
  
  <button class="postMapLoad btn btn-default" data-for="post">Map</button>
  <button type="submit" class="btn btn-default">Post</button>
</form>


