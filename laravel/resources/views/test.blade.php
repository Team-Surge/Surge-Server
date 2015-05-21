@extends('main')

@section('content')

    <div class="container"> 
    <br/>   

      
        <div class="col-sm-6">
          <ul class="nav nav-tabs" data-tabs="tabs">

          <?php $active = " active"; ?>
          @foreach (array_keys($tests) as $num => $group)
            <li class="{{$active}}" role="presentation" aria-controls="{{ $group }}" role="tab" data-toggle="tab"><a href="#{{ $group }}" data-toggle="tab">{{ $group }}</a></li>
            <?php $active = ""; ?>
          @endforeach
          </ul>
        

<div class="tab-content scrollable" id="tabsContainer">

<?php $active = " active"; ?>

@foreach ($tests as $group => $test)
            <div role="tabpanel" class="tab-pane{{$active}} ajax_test_group" id="{{$group}}">
            <?php $active = ""; ?>
  @foreach ($test as $testBlock)
            <div class="ajax_test_block">
            @include($testBlock)
            </div>
  @endforeach
            </div>
@endforeach

</div> 

        <!-- End scrollable-->
        </div>
        <div class="col-sm-6">
          <div class="heading_center">Query</div>
          <div class="ajax_test_url" id="ajaxTestUrl"></div>
          <pre class="ajax_test_query" id="ajaxTestQuery">
        
          </pre>
          <div class="heading_center">Result</div>
          <pre class="ajax_test_result" id="ajaxTestResult">
        
          </pre>
        </div>
      </div>

    </div><!-- /.container -->
    
<div id="mapModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
      
      <div class="map">
      <div id="map-canvas" style="width: 100%; height: 100%"></div>
      </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    
@endsection

@section('scripts')
    <script src="/js/testAjax.js"></script>
  <script type="text/javascript">

  function initialize() {
    var mapOptions = {
      zoom: 8,
      center: new google.maps.LatLng(33.97560937227514, -117.33961030840874)
    };

    map = new google.maps.Map(document.getElementById('map-canvas'),
        mapOptions);
  }

  function loadScript() {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp' +
        '&signed_in=true&callback=initialize';
    document.body.appendChild(script);
  }

  window.onload = loadScript;
  </script>
    
@endsection
