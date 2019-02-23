$(document).ready(function(){

  $("#js_change_password").change( function() {
    if ( $("#js_change_password").prop('checked') == true ) {
      $(".password_fields").show();
    }
    if ( $("#js_change_password").prop('checked') == false ) {
      $(".password_fields").hide();
    }
  });
} );
