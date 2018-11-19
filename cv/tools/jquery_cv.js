$(document).ready(function(){
    $("p.title").css('opacity', '0.7');
  $("div.detail").css('opacity', '0.9'); 
   var animationSpeed = 200;
  
  // ====================================================== //
  // ==     if an img (more detail icon) is CLICKED:    === //
  // ====================================================== //
  $('img[id^="More"]').click(function(){
  // first visible panel disappear
  // map menu already appear
  detailID = $(this).attr("id").substring(4);
  if ($("div#Detail"+detailID).is(":visible")){
    $("div#Detail"+detailID).slideUp(animationSpeed);
  }
  else{
    $("div#Detail"+detailID).slideDown(animationSpeed);
  }
  });
 
  // ====================================================== //
  // ==     if an img (more detail icon) is HOVERED:    === //
  // ====================================================== // 
  $('img[id^="More"]').hover(
    // mouse in
    function(){$(this).css('cursor','pointer');},
  // mouse out
  function(){$(this).css('cursor','auto');}
  );
  
  
  // ====================================================== //
  // ==            if div.someData is HOVERED:          === //
  // ====================================================== // 
  $('div.someData').hover(
    // mouse in
    function(){
    $(this).css({'border-color':'#003A48' , 'background':'#020922'});
    $(this).children('.title').animate({opacity:1} , animationSpeed);
  },
  // mouse out
  function(){
    $(this).css({'border-color':'#000835' , 'background':'#00011E'});
    $(this).children('.title').css({opacity:0.7} , animationSpeed);
  }
  );
  
    // ====================================================== //
  // ==            if div.detail is HOVERED:          === //
  // ====================================================== // 
  $('div.detail').hover(
    // mouse in
    function(){
    $(this).animate({ opacity : 1 } , animationSpeed);
  },
  // mouse out
  function(){
    $(this).animate({ opacity: 0.8 } , animationSpeed);
  }
  );
  
});