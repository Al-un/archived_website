/* *******************************************************************************************
 *                 INITIALIZE VARIABLES
 *********************************************************************************************/

/* For Menu */
var pho_MenuID            = 0;
var pho_Menu_Back_Closed  = "#fff8e7";
var pho_Menu_Back_Opened  = "#f3f2f2";
var pho_Menu_Prev_Back    = 0;

/* For Photos */
var photoNormalOpacity    = 0.8;
var photoHoverOpacity     = 1.0;
var animation_speed       = 150;    // in millisecond
var photoAreaId           = 0;
var photoAreaMaxHeight    = 0;      // to be calculated
var photoMove_Offset      = 0;
var photoMove_Offset_Max  = 0;      // to be calculated everytime
var photoMove_Offset_Step = 100;    // to be calculated everytime

/* *******************************************************************************************
 *                 WHEN PAGE LOADING IS FINISHED
 *********************************************************************************************/
 
$(document).ready(function(){



  /* *******************************************************************************************
   *                 PHO - HOME Page 
   *********************************************************************************************/

  // -- readjust home page background size
  $("div#Phobida_Home").height(window.innerHeight - $("div#Phobida_TopPanel").height());
  $("div#Phobida_Home").css("top", $("div#Phobida_TopPanel").height());



  /* *******************************************************************************************
   *                 PHO - PHO info Page 
   *********************************************************************************************/

  // -- readjust home page background size
  $("div#Phobida_Pho_Background").height(window.innerHeight - $("div#Phobida_TopPanel").height());
  $("div#Phobida_Pho_Background").css("top", $("div#Phobida_TopPanel").height());
  // $("div#Phobida_Pho").height(window.innerHeight - $("div#Phobida_TopPanel").height());

  // alert(window.innerHeight + " - " + $("div#Phobida_TopPanel").height() + " = " + (window.innerHeight - $("div#Phobida_TopPanel").height()) + " actual height: " + $("div#Phobida_Pho_Background").height());


  /* *******************************************************************************************
   *                 PHO - MENU Page 
   *********************************************************************************************/

  // -- readjust info page background size
  $("div#PhoMenu").height(window.innerHeight - $("div#Phobida_TopPanel").height());
  $("div#PhoMenu").css("top", $("div#Phobida_TopPanel").height());


  // hoverinh menu category
  $('div[id^="MenuCateContent"]').hover(
    function(){
      $(this).animate({borderWidth: 1 }, 'fast')
      // $(this).animate({border, "1px solid #947313"}, 500);
    },
    function(){
      $(this).animate({borderWidth: 0 }, 'fast')
    }
  )

  // expand menu when clicking
  $('div[id^="MenuCateContent"]').click(function(){
      pho_MenuID = $(this).attr('id').substring(15);
      if ($("div#MenuItemContent" + pho_MenuID).is(":visible")){  // Checks for display:[none|block], ignores visible:[true|false]
        $(this).css("background", pho_Menu_Back_Opened);
        $("div#MenuItemContent" + pho_MenuID).slideUp();
      }
      else{
        $(this).css("background", pho_Menu_Back_Closed);
        $("div#MenuItemContent" + pho_MenuID).slideDown();
      }
    })





  /* *******************************************************************************************
   *                 PHO - PHOTO Page 
   *********************************************************************************************/

  // adjust div elements height 
  $("div#Phobida_Photo").height(window.innerHeight - $("div#Phobida_TopPanel").height());
  $("div#Phobida_Photo").css("top", $("div#Phobida_TopPanel").height());

  // calculate photo variable

  while ($("div#Pho_Photo_Col"+photoAreaId).length){
    photoAreaMaxHeight = Math.max(photoAreaMaxHeight, $("div#Pho_Photo_Col"+photoAreaId).height());
    photoAreaId = photoAreaId + 1;
  }

  photoMove_Offset_Step = ($("div#Phobida_PhotoArea").length) ? 0.5*$("div#Phobida_PhotoArea").height() : 0;
  photoMove_Offset_Max  = ($("div#Pho_Photo_Col0").length) ? Math.floor(
                          (photoAreaMaxHeight - $("div#Phobida_PhotoArea").height()) / photoMove_Offset_Step) + 1 : 0;
  // alert( (photoAreaMaxHeight +" - " + $("div#Phobida_PhotoArea").height()) + " / " + photoMove_Offset_Step + " = " + photoMove_Offset_Max);

  // initialize page after loading is finished
  $('a[id^="PhoPhoto"] img').css("opacity", photoNormalOpacity);


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



  $("div#MoveUp").click(function(){
    if(photoMove_Offset > 0){
      $("div#Phobida_PhotoWrapper").animate({marginTop: '+='+photoMove_Offset_Step+'px'}, "fast");
      photoMove_Offset = photoMove_Offset - 1;
      // alert(photoMove_Offset);
    }
  });
  $("div#MoveDown").click(function(){
    if(photoMove_Offset < photoMove_Offset_Max){
      $("div#Phobida_PhotoWrapper").animate({marginTop: '-='+photoMove_Offset_Step+'px'}, "fast");
      photoMove_Offset = photoMove_Offset + 1;
        // alert(photoMove_Offset);
    }
  });

  




  /* *******************************************************************************************
   *                 PHO - INFO Page 
   *********************************************************************************************/
  
  // -- readjust info page background size
  $("div#Phobida_Info_Background").height(window.innerHeight - $("div#Phobida_TopPanel").height());
  $("div#Phobida_Info").height(window.innerHeight - $("div#Phobida_TopPanel").height());
  $("div#Phobida_Info_Background").css("top", $("div#Phobida_TopPanel").height());
  $("div#Phobida_Info").css("top", $("div#Phobida_TopPanel").height());
  $("div#GoogleMaps").height(0.9*$("div#Phobida_Info_Background").height());
});
 
 
 
 