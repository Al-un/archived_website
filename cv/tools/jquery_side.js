$(document).ready(function(){

	$("div#homepage").css('opacity', '0.6');
	$("div.language").css('opacity', '0.6');
	


  var animation_speed = 200;
  var opacity_min = 0.3;
  var opacity_max = 1;
  
  
  // ====================================================== //
  // ===          if a Language Div is HOVERED:         === //
  // ====================================================== //
  $('#MainLanguage').hover(
    // mouse in
    function(){$('#MainLanguage').animate({opacity: opacity_max}, animation_speed);},
	// mouse out
	function(){$('#MainLanguage').animate({opacity: opacity_min}, animation_speed);}
  );
  
  // ====================================================== //
  // ===         if a LoginForm Div is HOVERED:         === //
  // ====================================================== //
  $('#MainLoginForm').hover(
    // mouse in
    function(){$('#MainLoginForm').animate({opacity: opacity_max}, animation_speed);},
	// mouse out
	function(){$('#MainLoginForm').animate({opacity: opacity_min}, animation_speed);}
  ); 

  
  // ====================================================== //
  // ===          if a HOME PAGE IMG is HOVERED:        === //
  // ====================================================== //
  $('div#homepage').hover(
    // mouse in
    function(){$(this).animate({opacity: opacity_max}, animation_speed);},
	// mouse out
	function(){$(this).animate({opacity: opacity_min}, animation_speed);}
  );
});