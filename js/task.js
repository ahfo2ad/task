$(function () {

    // show and hide focus function

    $("[placeholder]").focus(function(){

        $(this).attr("data-text", $(this).attr("placeholder"));

        $(this).attr("placeholder", "");
    }).blur(function(){

        $(this).attr("placeholder", $(this).attr("data-text"));
    });
    
});


$( function() {
    $( "#datepicker" ).datepicker({
        dateFormat: 'yy/mm/dd',
      showOtherMonths: true,
      selectOtherMonths: true
    });
  } );