
$(document).ready(function(){

function tsSize()
{
  var height = ($(window).height() - 100);
  $('#testScroller').css('maxHeight', height + "px");
}

$(window).resize(
function(){
tsSize();
});

tsSize();

// Attach a submit handler to the form
$( '.ajax_test_form' ).submit(function( event ) {
 
  // Stop form from submitting normally
  event.preventDefault();
 
  // Get some values from elements on the page:
  var form = $( this ),

    
  url = $(form).attr( "action" );
 
  data = {};
  
  raw = $(form).serializeArray();
  
  $(raw).each(
    function(n, e){
      data[e.name] = e.value;
    }
  );
 
  // Grab the data, create json, newline separated, remove duplicate newlines.
  $('#ajaxTestQuery').empty().text( JSON.stringify(data, null, "\n").replace(/(\n)+/g,"\n") );
  
  // Specify URL
  $('#ajaxTestUrl').empty().text(url);
  
  // Send the data using post
  var posting = $.post( url, data  );
 
  // Put the results in a div
  posting.done(function( data ) {
    $('#ajaxTestResult').empty().text(data);
  });
});

});

