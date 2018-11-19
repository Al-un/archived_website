/*********************************************************************************************
 *                 INITIALIZE VARIABLES
 *********************************************************************************************/
var photoNormalOpacity    = 0.8;
var photoHoverOpacity     = 1.0;
var animation_speed       = 150;    // in millisecond
var picture_height        = 0;
var picture_width         = 0;
var a_block_height        = 0;
var a_block_width         = 0;

/*********************************************************************************************
 *                 WHEN PAGE LOADING IS FINISHED
 *********************************************************************************************/
 
$(document).ready(function(){

  // initialize page after loading is finished
  $('a[id^="PhoPhoto"] img').css("opacity", photoNormalOpacity);
  a_block_height  = $('a#PhoPhoto1').height();  // .height() return raw values whereas .css('height') returns
  a_block_width   = $('a#PhoPhoto1').width();   // the value with the unit measure: e.g. 400px instead of 400.
  $('a[id^="PhoPhoto"] img').each(function(){
    picture_height = $(this).height();
    picture_width  = $(this).width();
    
    if ((picture_width/picture_height) > (a_block_width/a_block_height)){
      // alert("pic wid: " + picture_width + "pic height: " + picture_height + " vs a wid:"+ a_block_width + "a height:" + a_block_height);
      $(this).css("height", "100%");
      $(this).css("width", "auto");
    }
    else{
      // alert("PLop pic wid: " + picture_width + "pic height: " + picture_height + " vs a wid:"+ a_block_width + "a height:" + a_block_height);
      $(this).css("height", "auto");
      $(this).css("width", "100%");
    }
  })



  // if a Pho Photo is hovered
  $('a[id^="PhoPhoto"] img').hover(
    function() {
      $(this).animate( {opacity: photoHoverOpacity}, animation_speed);
    },
    function() {
      $(this).animate( {opacity: photoNormalOpacity}, animation_speed);
    });
  

  // if a Pho Photo is clicked
  $("a[rel=PhoPhotoGallery]").fancybox({
    'transitionIn'   : 'none',
    'transitionOut'  : 'none',
    'titlePosition'  : 'over',
    'titleFormat'    : function(title, currentArray, currentIndex, currentOpts) {
       return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
     }
  });
  
  
});
 
 
 
 