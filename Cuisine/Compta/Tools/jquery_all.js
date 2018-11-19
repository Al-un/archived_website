/*********************************************************************************************
 *                 INITIALIZE VARIABLES
 *********************************************************************************************/
var artmenu_curId = 0;  // home page opened
var artcate_curId = 0;  // no cate is displayed
var artitem_curId = 0;  // no item is displayed
var artmenu_curStyle = "artmenu_1";
var artcate_curStyle = "artcate_1";
var artitem_curStyle = "artitem_1";
var artmenu_NbOfStyle = 1;
var artcate_NbOfStyle = 2;
var artitem_NbOfStyle = 2;


/*********************************************************************************************
 *                 WHEN PAGE LOADING IS FINISHED
 *********************************************************************************************/
 
$(document).ready(function(){
  
  /*
  if ($("body").attr('id').length > 7){
    var artload = $("body").attr('id').split("-");
	
	if (artload[1].length > 0){
	  switch(artload[0]){
	    case "artitem": showArtItem(artload[1]); break;
	    case "artcate": showArtCate(artload[1]); break;  
	    case "artmenu": showArtMenu(artload[1]); break;
	  }
	}
	else{
	  alert($("body").attr('id'));
	  showArtMenu(1);
	}
  }
  else{
	showArtMenu(1);
  }
  */
});



/*********************************************************************************************
 *                 CHANGE PANEL (check if changing panel or not)
 *********************************************************************************************/
 








 
function switchCurrentContentFor(panelToShow, id){

  var hidingTime = 60;

  switch(panelToShow){
    
	case "ArtMenu":
		// go to ArtCate from an ArtMenu or an ArtItem
		if ($("div#PanelArtCate").is(":visible")){
		  hidingTime += hideArtCatePanel();
		  hidingTime += showArtMenuPanel();
		  hideArtCateItemPanel();
		}
		else if ($("div#PanelArtItem").is(":visible")){
		  hidingTime += hideArtItemPanel();
		  hidingTime += showArtMenuPanel();
		  hideArtCateItemPanel();
		}
		// already on a ArtMenu? then switch cur artmenu_id
		else if ($("div#PanelArtMenu").is(":visible") && artmenu_curId != id){
		  artmenu_curId = id;
		  hidingTime += hideArtMenuContent();
		}
		break;
	case "ArtCate":
		// go to ArtCate from an ArtMenu or an ArtItem
		if ($("div#PanelArtMenu").is(":visible")){
		  hidingTime += hideArtMenuPanel();
		  hidingTime += showArtCatePanel();
		}
		else if ($("div#PanelArtItem").is(":visible")){
		  hidingTime += hideArtItemPanel();
		  hidingTime += showArtCatePanel();
		  hideArtCateItemPanel();
		}
		// already on a ArtCate?
		else if ($("div#PanelArtCate").is(":visible") && artcate_curId != id){
		  artcate_curId = id;
		  hideArtCateItemPanel();
		  hidingTime += hideArtCateContent();
		}
		break;
  
 
	
	case "ArtItem":	  
		// go to ArtCate from an ArtMenu or an ArtItem
		if ($("div#PanelArtMenu").is(":visible")){
		  hidingTime += hideArtMenuPanel();
		  hidingTime += showArtItemPanel();
		}
		else if ($("div#PanelArtCate").is(":visible")){
		  hidingTime += hideArtCatePanel();
		  hidingTime += showArtItemPanel();
		}
		// already on a ArtCate?
		else if ($("div#PanelArtItem").is(":visible") && artitem_curId != id){
		  artitem_curId = id;
		  hidingTime += hideArtItemContent();
		}
		break;
  }

  return hidingTime;
}




function verticalAlign(ItemSelector){
  $(ItemSelector).each(function(){
	var marginTop = (  ($(this).parent().height() - $(this).height()) *0.42);
	/*if ($(this).parent().attr('id') == "PanelArtMenu"){
	alert(marginTop+": " +$(this).parent().attr('id') + " -- " + $(this).attr('id') + " == " + $(this).parent().height() +"-"+ $(this).height());
	}*/
	$(this).css('margin-top', marginTop);
  });
}

 
 
 
 
 
 