
$(document).ready(function(){

function tsSize()
{

  var height = ($(window).height() - $('#tabsContainer').offset().top - 20);
  $('#tabsContainer').css('maxHeight', height + "px");
}

$(window).resize(
function(){
tsSize();
});

tsSize();


$('input:submit').click(
function(){

var form = $(this).closest('form');

$(this).attr('data-timestamp', Date.now());

});

// Attach a submit handler to the form
$( '.ajax_test_form' ).submit(function( event ) {
 
  // Stop form from submitting normally
  event.preventDefault();
 
  // Get some values from elements on the page:
  var form = $( this ),
 
  url = $(form).attr( "action" );
 
  data = {};
  
  raw = $(form).serializeArray();
  
  var timestamp = 0;
  var name="";
  var value="";
  
  $(form).children('input:submit').each(
    function()
    {
      var submit = $(this);
      
      if(submit.attr('data-timestamp') > timestamp)
      {
        timestamp = submit.attr('data-timestamp');
        name = $(this).attr('name');
        value = $(this).attr('value');
      }
    }
  );
  
  $(raw).each(
    function(n, e){
      data[e.name] = e.value;
    }
  );
  
  if(name != "")
  {
    data[name] = value;
  }
 
  // Grab the data, create json, newline separated, remove duplicate newlines.
  $('#ajaxTestQuery').empty().text( JSON.stringify(data, null, "\n").replace(/(\n)+/g,"\n") );
  
  // Specify URL
  $('#ajaxTestUrl').empty().text(url);
  
  // Show loading in the result...
  $('#ajaxTestResult').empty().text("Loading...");
  
  // Send the data using post
  var posting = $.post( url, data  );
 
  // Put the results in a div
  posting.done(function( data ) {
    $('#ajaxTestResult').empty().text(data);
  });
});

$('.postMapLoad').click(function(e)
{
  e.preventDefault();
  
  mapfor = $(e.target).attr('data-for');
  
  var modal = $('#mapModal');
  var save = $('#mapSave');
  
  modal.modal('show');
  
  modal.on('shown.bs.modal', function(e)
  {
    google.maps.event.trigger(map, "resize");
  });
  
  google.maps.event.addListener(map, 'click', function(event) {

      //marker = new google.maps.Marker({position: event.latLng, map: map});
      
      $('#mapLat' + '_' + mapfor).val(event.latLng.lat())
      $('#mapLng' + '_' + mapfor).val(event.latLng.lng())

  });

});

});

