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
@endsection
