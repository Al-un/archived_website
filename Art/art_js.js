/* *******************************************************************************************
 *                 INITIALIZE VARIABLES
 ******************************************************************************************* */

/* ---------------------------------------- */
/* global variables in art zone */
  var artSort           = "Date";
  var artActiveId       = 0;
  var artNewId          = 0;
  var artChangeTime     = 200; /* time in millisecond for changing thing in design */
/* ---------------------------------------- */
/* size in percentage : */
  var divLeftHeight     = 0.92; /* careful : left and right have to be inverted */
  var divHeaderHeight   = 0.04;
  var divFootBlockHeight= 0.40;
  var divFootHeadHeight = 0.99; /* just for the head. % of footer height: cannot go through footer ! */
  var divLeftWidth      = 0.10; /* careful : left and right have to be inverted */
  var divCentralWidth   = 0.66;
  var divFootBlockWidth = 0.23; 
  var divFootBlockMargin= 0.01; /* margin in % for foot block */
  /* calculated size, in percentage */
  var divCentralHeight  = divLeftHeight;
  var divRightHeight    = divLeftHeight+divHeaderHeight;
  var divFooterHeight   = 1-divRightHeight;
  var divRightWidth     = 1-(divLeftWidth+divCentralWidth);
  var divHeaderWidth    = divLeftWidth+divCentralWidth;
  var divFooterWidth    = 1;
  /* size for calculation in pixels */
  var windowHeight      = 0;
  var windowWidth       = 0;
  var divMargin         = 4; /* should be an even value */
/* ---------------------------------------- */
/* variable for slide show div size in pixel */
  var divContentWidth   = 0;
  var divContentHeight  = 0;
  var divSummaryWidth   = 0;
  var divSummeryHeight  = 0;
  var divCommentWidth   = 0;
  var divCommentHeight  = 0;

/* ---------------------------------------- */
/* variable for permalink activation */
  var permaId           = -1;
/* ---------------------------------------- */
/* for nice animation */
  var artAreaNewWidth   = 0;
  var artAreaOldWidth   = 0;
  var artDescNewWidth   = 0;
  var artDescOldWidth   = 0;
  var artDeltaWidth     = 0;
/* ---------------------------------------- */
/* for art gallery slide show */
  var artGalleryId      = 0;
  var artGalleryTitle   = "";
  var artGalleryNumber  = 0;
  var artGalleryWidth   = 0;
  var artGalleryMode    = "Full Width";

/* *******************************************************************************************
 *                 Custom functions
 ******************************************************************************************* */

jQuery.fn.extend({

  /* -- adjust block size (height / width) because css height % is based on width :( -- */
  artAdjustBlockSize : function(newWidth, newHeight, cssTop, cssLeft){
    this.height(newHeight);
    this.width(newWidth);
    this.css({top: cssTop+'px', left : cssLeft+'px'});
  },

  /* -- adjust picture size in one or several containers -- */
  artFitPicSizeInContainers : function(containerIdLength, picIdName, marginPic, fixedContainerWidth, fixedContainerHeight, displayAlert){

    var containerId       = 0;
    var artAreaId         = 0;
    var divContHeight     = 0; /* container height */
    var divContWidth      = 0; /* container width */
    var imgArtHeight      = 0; /* art list picture height */
    var imgArtWidth       = 0; /* art list picture width */

    this.each(function (){
      containerId   = $(this).attr('id').substring(containerIdLength);
      divContHeight = $(this).height()-2*marginPic;
      divContWidth  = $(this).width()-2*marginPic;
      imgArtHeight  = $(picIdName+containerId).height();
      imgArtWidth   = $(picIdName+containerId).width();
      newValue      = 0;
      /* if the picture is "more" portrait than the div 
       * then after resizing, thanks to width/height hardcoding,
       * image is marginLeft or marginTop to central align
       */
      
      if ( (imgArtHeight/imgArtWidth) > (divContHeight/divContWidth) ){
        newValue = Math.round((imgArtWidth/imgArtHeight)*(divContHeight));
        $(picIdName+containerId).height(divContHeight);
        $(picIdName+containerId).width( newValue );
        if(fixedContainerWidth){
          $(picIdName+containerId).css({marginTop: marginPic+"px", marginLeft: ( (divContWidth-newValue)/2 )+'px'});
        }
        else{
          $(picIdName+containerId).css({marginTop: marginPic+"px", marginLeft: marginPic+'px'});
          $(this).width(newValue+2*marginPic);
        }
      }else{
        newValue = Math.round((imgArtHeight/imgArtWidth)*(divContWidth));
        $(picIdName+containerId).width(divContWidth);
        $(picIdName+containerId).height( newValue );
        if(fixedContainerHeight){
          $(picIdName+containerId).css({marginTop: ( (divContHeight-newValue)/2 )+'px', marginLeft: marginPic+"px"});
        }
        else{
          $(picIdName+containerId).css({marginTop: marginPic+"px", marginLeft: marginPic+'px'});
          $(this).height(newValue+2*marginPic);
        }
      }

      if(displayAlert){
        alert(" >> Container height/width :"+ divContHeight + "px / " + divContWidth + "px \n" +
        "Ratio height/width for art <> container " + (imgArtHeight/imgArtWidth) +" <> "+ (divContHeight/divContWidth) + "\n" +
        picIdName+containerId+" :: \n" + 
        " Pic old height/width : " + imgArtHeight + "px /" + imgArtWidth + "px \n"+
        " Pic new height/width : " + $(picIdName+containerId).height() + "px / " + $(picIdName+containerId).width() + "px \n"+
        " Pic marginLeft: " + $(picIdName+containerId).css("marginLeft") + "px / marginTop: " + $(picIdName+containerId).css("marginTop") +"px");
      }
    })
  }

});


/* *******************************************************************************************
 *                 LOADING STUFF
 ******************************************************************************************* */
// $(document).on({
    // ajaxStart : function(){$("div#to").addClass("changeColorRed");},
    // ajaxStop  : function(){$("div#to").addClass("changeColorGreen");}
// });

$(window).load(function() {

})

/* *******************************************************************************************
 *                 HERE WE GO
 ******************************************************************************************* */
$(document).ready(function(){

  divContentWidth   = $("div#GalleryContent").width();
  divContentHeight  = $("div#GalleryContent").height();
  divSummaryWidth   = $("div#GallerySummary").width();
  divSummaryHeight  = $("div#GallerySummary").height();
  divCommentWidth   = $("div#GalleryComment").width();
  divCommentHeight  = $("div#GalleryComment").height();
  $("div#GallerySlideShow").hide();

  /* add CSS class */
  $("div#Xsy_Glob_Left").addClass("block");
  $("div#Xsy_Glob_Page").addClass("block");
  $("div#Xsy_Glob_Right").addClass("block");
  $("div#Art_Header").addClass("block");
  $("div#Art_Footer").addClass("block");

  /* resize all blocks */
  windowHeight  = $(window).height();
  windowWidth   = $(window).width();
  divLeftHeight     = Math.round(divLeftHeight*windowHeight - 2*divMargin);
  divCentralHeight  = Math.round(divCentralHeight*windowHeight - 2*divMargin);
  divRightHeight    = Math.round(divRightHeight*windowHeight - 2*divMargin); 
  divHeaderHeight   = Math.round(divHeaderHeight*windowHeight - 2*divMargin);
  divFooterHeight   = Math.round(divFooterHeight*windowHeight - 2*divMargin);
  divFootBlockHeight= Math.round(divFootBlockHeight*windowHeight);
  divLeftWidth      = Math.round(divLeftWidth*windowWidth - 2*divMargin);
  divCentralWidth   = Math.round(divCentralWidth*windowWidth - 2*divMargin);
  divRightWidth     = Math.round(divRightWidth*windowWidth - 2*divMargin);
  divHeaderWidth    = Math.round(divHeaderWidth*windowWidth - 2*divMargin);
  divFooterWidth    = Math.round(divFooterWidth*windowWidth - 2*divMargin);
  divFootBlockWidth = Math.round(divFootBlockWidth*windowWidth);

  divFootBlockMargin= Math.round(divFootBlockMargin*windowWidth);
  divFootHeadHeight = Math.round(divFootHeadHeight*divFooterHeight);


  /* left has right width / height */
  $("div#Xsy_Glob_Left").artAdjustBlockSize(divRightWidth, divRightHeight, divMargin, divHeaderWidth+3*divMargin);
  $("div#Xsy_Glob_Page").artAdjustBlockSize(divCentralWidth, divCentralHeight, divHeaderHeight+3*divMargin, divLeftWidth+3*divMargin);
  /* right has left width /height */
  $("div#Xsy_Glob_Right").artAdjustBlockSize(divLeftWidth, divLeftHeight, divHeaderHeight+3*divMargin, divMargin);
  $("div#Art_Header").artAdjustBlockSize(divHeaderWidth, divHeaderHeight, divMargin, divMargin);
  $("div#Art_Footer").artAdjustBlockSize(divFooterWidth, divFooterHeight, divRightHeight+3*divMargin, divMargin);
  /* alert("Left : "+divLeftWidth+" x "+divLeftHeight+"\n"+"Right : "+divRightWidth+" x "+divRightHeight+"\n"+"Central : "+divCentralWidth+" x "+divCentralHeight+"\n"+"Header : "+divHeaderWidth+" x "+divHeaderHeight+"\n"+"Footer : "+divFooterWidth+" x "+divFooterHeight); */
  /* for all footer block */
  $("div#ArtHome").artAdjustBlockSize(divFootBlockWidth, divFootBlockHeight, windowHeight-divFootHeadHeight, divFootBlockMargin);
  $("div#ArtAbout").artAdjustBlockSize(divFootBlockWidth, divFootBlockHeight, windowHeight-divFootHeadHeight, divFootBlockWidth+3*divFootBlockMargin);
  $("div#ArtContact").artAdjustBlockSize(divFootBlockWidth, divFootBlockHeight, windowHeight-divFootHeadHeight, 2*divFootBlockWidth+5*divFootBlockMargin);
  $("div#ArtLink").artAdjustBlockSize(divFootBlockWidth, divFootBlockHeight, windowHeight-divFootHeadHeight, 3*divFootBlockWidth+7*divFootBlockMargin);
  $("div.FootBlock > p.header").height(divFootHeadHeight); // adjust header head;

  /* resize some containers */
  $("div#ArtArea").height($("div#Xsy_Glob_Page").height()-12);
  $("div#ArtDesc").height($("div#Xsy_Glob_Page").height()-12);
  artAreaOldWidth = $("div#ArtArea").width();
  $("div#ArtList_ForScroll").height($("div#Xsy_Glob_Left").height()-25);

  /* move left/right blocks */
  if($("div#GoToLeft").length){
    $("div#Xsy_Glob_Right").append($("div#GoToLeft").html());
    $("div#GoToLeft").remove();
  }
  if($("div#GoToRight").length){
    $("div#Xsy_Glob_Left").append($("div#GoToRight").html());
    $("div#GoToRight").remove();
  }

  /* adjust picture size for ArtList */
  divClass              = "ArtList_Container";
  marginPic             = 0;
  fixedContainerWidth   = true;
  fixedContainerHeight  = true;
  displayAlert          = false;
  $("div."+divClass).artFitPicSizeInContainers(divClass.length, "img#OpenArt", marginPic, fixedContainerWidth, fixedContainerHeight, displayAlert);
  /* adjust picture size for ArtArea */
  divClass              = "ArtArea";
  marginPic             = 10;
  fixedContainerWidth   = false;
  $("div."+divClass).artFitPicSizeInContainers(divClass.length, "img#ArtArea_Image", marginPic, fixedContainerWidth, fixedContainerHeight, displayAlert);


  /* add scroll bar whenever everything is finished. 
   * scroll in case of too long text */
  $("#ArtList_ForScroll").scroller().removeClass("scroller-active");
  $(".ArtDescArea").scroller();
  $(".ArtAdministration").scroller();
  $("#GallerySummary").scroller();
  $("#GalleryContent").scroller();
  $("#GalleryComment").scroller();

  /* if nothing selected, permalink = -1 */
    permaId = $("div#Art_PermaLink").text();
    openArtArea(permaId);
    artActiveId = permaId;


  /* -------------------------------------------------------------------------- */
  /* Footer stuff: pop out foot block*/
  /* -------------------------------------------------------------------------- */
  $("div.FootBlock").click(function(){

    var footBlockID = $(this).attr('id');
    if (footBlockID == "ArtHome"){
      $("div#ArtAbout").animate({marginTop: 0, opacity: 0.2}, artChangeTime);
      $("div#ArtContact").animate({marginTop: 0, opacity: 0.2}, artChangeTime);
      $("div#ArtLink").animate({marginTop: "0px", opacity: 0.2}, artChangeTime);
    }
    else if($(this).css("margin-top")=="0px"){
    /* alert($(this).css("margin-top") + "  vs  " + $("div#Art_Footer").css("Top")); */
    /*  alert(divFootBlockHeight +" - "+ divFootHeadHeight+"=" +(divFootBlockHeight - divFootHeadHeight));*/
      $(this).animate({marginTop: "-=" + (divFootBlockHeight - divFootHeadHeight) +"px", opacity: 0.9}, artChangeTime);
    }
    else{
      $(this).animate({marginTop: "+=" + (divFootBlockHeight - divFootHeadHeight) +"px", opacity: 0.2}, artChangeTime);
    }
  });


  $("div.FootBlock").hover(function(){
    $(this).animate({opacity: 0.9}, artChangeTime);
  }, function(){
    if($(this).css("margin-top")=="0px"){
      $(this).animate({opacity: 0.1}, artChangeTime);
    }
  });



  /* -------------------------------------------------------------------------- */
  /* move to a specific artitem */
  /* -------------------------------------------------------------------------- */
  $("img[id^='OpenArt']").click(function(){
    artNewId = $(this).attr('id').substring(7);
    if (artNewId != artActiveId) {

      closeArtArea(artActiveId);

      artAreaNewWidth = $("div#ArtArea"+artNewId).width();
      // artAreaNewWidth = $("img#ArtArea_Image"+artNewId).width();
      artDeltaWidth   = artAreaNewWidth-artAreaOldWidth
      // alert("Delta is " + artDeltaWidth + "px due to " + artAreaNewWidth + " - " + artAreaOldWidth);
      if(artDeltaWidth>0){
        $("div#ArtArea").delay(artChangeTime).animate({width: "+="+Math.abs(artDeltaWidth)+"px"}, artChangeTime);
        $("div#ArtDesc").delay(artChangeTime).animate({width: "-="+Math.abs(artDeltaWidth)+"px"}, artChangeTime);
      }else{
        $("div#ArtArea").delay(artChangeTime).animate({width: "-="+Math.abs(artDeltaWidth)+"px"}, artChangeTime);
        $("div#ArtDesc").delay(artChangeTime).animate({width: "+="+Math.abs(artDeltaWidth)+"px"}, artChangeTime);
      }
      artAreaOldWidth = artAreaNewWidth;

      openArtArea(artNewId);
      artActiveId = artNewId;
    }
  });



  /* -------------------------------------------------------------------------- */
  /* an image is click : pop it out with original and others */
  /* -------------------------------------------------------------------------- */
  $("img.ArtArea_Image").click(function(){

    artGalleryNumber  = 0;
    artGalleryId      = 0;
    artGalleryTitle   = $(this).attr('title');

    $("img[title^='"+artGalleryTitle+"']").each(function(){
      /* Append to summary */
      $("div#GallerySummary > div.scroller-content").append("   <div id='ArtGallerySummary"+artGalleryNumber+"' class='ArtSummary_Item'>      <img id='ArtGallerySummary_Image"+artGalleryNumber+"' src='"+$(this).attr("src")+"' title='"+$(this).attr('alt')+"' width='"+$(this).width()+"px' height='"+$(this).height()+"px' />\n   </div>\n");
      /* Append to content */
      $("div#GalleryContent > div.scroller-content").append("   <div id='ArtGalleryContent"+artGalleryNumber+"' class='ArtContent_Item'>\n      <img id='ArtGalleryContent_Image"+artGalleryNumber+"' src='"+$(this).attr("src")+"' style='width:"+$(this).width()+"px;height:"+$(this).height()+"px;' />\n   </div>\n");
        $("div#ArtGalleryContent"+artGalleryNumber).width(divContentWidth);
        $("div#ArtGalleryContent"+artGalleryNumber).height(divContentHeight);
      /* Append to comment */
      $("div#GalleryComment > div.scroller-content").append("   <div id='ArtGalleryComment"+artGalleryNumber+"' class='ArtComment_Item'>\n      <p>"+$(this).attr('alt')+"</p>\n   </div>\n");
      artGalleryNumber++;
    });


    if(artGalleryMode=="Fit Picture"){
      fitGalleryPictureSize();
    }
    else{
      fullWidthGalleryPic();
    }


    $("div#GallerySlideShow").delay(artChangeTime).fadeIn(artChangeTime);
    openArtGallery(artGalleryId);
  });


  /* switch item */
  $("div#GallerySummary").on("click", "img[id^='ArtGallerySummary']", function(){
    artGalleryTitle = $(this).attr('id').substring(23);
    if(artGalleryTitle!==artGalleryId){
      closeArtGallery(artGalleryId);
      openArtGallery(artGalleryTitle);
      artGalleryId  = artGalleryTitle;
    }
  });

  /* full width gallery */
  $("div#GalleryWidth").click(function(){
    if(artGalleryMode=="Fit Picture"){ /* it was in Fit mode so user has click on "full width" button */
      fullWidthGalleryPic();
      artGalleryMode = "Full Width";
      $(this).text("Fit Picture");
    }
    else{
      fitGalleryPictureSize();
      artGalleryMode = "Fit Picture";
      $(this).text("Full Width");
    }
  });

  /* to close the gallery by pressing "escape" key or click the "close" button */
  $(document).keyup(function(e) {
    if (e.keyCode == 27)  { // esc 
      $("div#GallerySummary > div.scroller-content").empty();
      $("div#GalleryContent > div.scroller-content").empty();
      $("div#GalleryComment > div.scroller-content").empty();
      $("div#GallerySlideShow").fadeOut(artChangeTime);
    }
  });
  $("div#GalleryClose").click(function(){
    $("div#GallerySummary > div.scroller-content").empty();
    $("div#GalleryContent > div.scroller-content").empty();
    $("div#GalleryComment > div.scroller-content").empty();
    $("div#GallerySlideShow").fadeOut(artChangeTime);
  });



  /* --------------------------------------------------------------------------- */
  /* ---- for comments (textarea) with limited size
  /* --------------------------------------------------------------------------- */
  $("textarea[maxlength]").each(function() {
      var $this = $(this);
      var maxLength = parseInt($this.attr('maxlength'));
      $this.attr('maxlength', null);
      
      var el = $("<span class=\"character-count\">" + maxLength + "</span>");
      el.insertAfter($this);
      
      $this.bind('keyup', function() {
          var cc = $this.val().length;
          
          el.text(maxLength - cc);
          
          if(maxLength < cc) {
              el.css('color', 'red');
          } else {
              el.css('color', null);
          }
      });
  });

});




/*
 * display an art with its description, properties..
 */
function openArtArea(artNewId){
  $("div#ArtPropArea"+artNewId).delay(2*artChangeTime).slideDown(artChangeTime);
  $("div#ArtTagArea"+artNewId).delay(2*artChangeTime).slideDown(artChangeTime);
  $("div#ArtSocMedia"+artNewId).delay(2*artChangeTime).slideDown(artChangeTime);
  $("div#ArtCommArea"+artNewId).delay(2*artChangeTime).show();
  $("div#ArtArea"+artNewId).delay(2*artChangeTime).fadeIn(artChangeTime);
  $("div#ArtDescArea"+artNewId).delay(2*artChangeTime).fadeIn(artChangeTime);
}
/*
 * close an art with its description, properties..
 */
function closeArtArea(artActiveId){
  $("div#ArtPropArea"+artActiveId).slideUp(artChangeTime);
  $("div#ArtTagArea"+artActiveId).slideUp(artChangeTime);
  $("div#ArtSocMedia"+artActiveId).slideUp(artChangeTime);
  $("div#ArtCommArea"+artActiveId).hide();
  $("div#ArtArea"+artActiveId).fadeOut(artChangeTime);
  $("div#ArtDescArea"+artActiveId).fadeOut(artChangeTime);
}

/*
 * to switch between pics in summary gallery
 */
function openArtGallery(artId){
  /* open new */
  $("div#ArtGalleryContent"+artId).fadeIn(artChangeTime);
  $("div#ArtGalleryComment"+artId).fadeIn(artChangeTime);
}
function closeArtGallery(artId){
  /* close old */
  $("div#ArtGalleryContent"+artId).fadeOut(artChangeTime);
  $("div#ArtGalleryComment"+artId).fadeOut(artChangeTime);
}

function fitGalleryPictureSize(){

  var ratio = 0;
  $(".ArtContent_Item img").each(function(){
    ratio = $(this).height() / $(this).width();
    $(this).animate({width: (divContentHeight/ratio), height: divContentHeight, marginLeft: (divContentWidth-(divContentHeight/ratio))/2}, artChangeTime);
  });
}

function fullWidthGalleryPic(){
  var ratio = 0;
  $(".ArtContent_Item img").each(function(){
    ratio = $(this).height() / $(this).width();
    $(this).animate({width: divContentWidth, height: (ratio*divContentWidth), marginLeft: 0}, artChangeTime);
  });
}


