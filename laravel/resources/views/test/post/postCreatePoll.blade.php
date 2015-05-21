<!-- Create yak (logged in)-->

<span class="ajax_test_name">Create Post (with poll)</span>
<form class="ajax_test_form" action="/post" method="post">  
  <input type="hidden" name="action" value="postCreate"/>
  <input type="hidden" name="type" value="poll"/>
  <div class="form-group">
    <label>Handle</label>
    <input type="text" name="handle" class="form-control"/>
  </div>
  <div class="form-group">
    <label>Post</label>
    <textarea name="content" class="form-control"></textarea>
  </div>
  <div class="form-group">
    <label>Option Count</label>
    <textarea name="pollOptionCount" class="form-control"></textarea>
  </div>
  <div class="form-group">
    <label>Option 1</label>
    <input type="text" name="pollOption1" class="form-control"/>
  </div>
  <div class="form-group">
    <label>Option 2</label>
    <input type="text" name="pollOption2" class="form-control"/>
  </div>
  <div class="form-group">
    <label>Option 3</label>
    <input type="text" name="pollOption3" class="form-control"/>
  </div>
  <div class="form-group">
    <label>Option 4</label>
    <input type="text" name="pollOption4" class="form-control"/>
  </div>
  
  <div class="form-group">
    <label>Lat</label>
    <input id="mapLat_poll" name="lat" class="form-control"/>
  </div>
  
  <div class="form-group">
    <label>Lng</label>
    <input id="mapLng_poll" name="lng" class="form-control"/>
  </div>
  
  <button class="postMapLoad btn btn-default" data-for="poll">Map</button>
  <button type="submit" class="btn btn-default">Post</button>
</form>

