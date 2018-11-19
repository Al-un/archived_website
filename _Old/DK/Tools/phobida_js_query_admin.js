/* *******************************************************************************************
 *                 INITIALIZE VARIABLES
 *********************************************************************************************/
var pho_MenuID = 0;

/* *******************************************************************************************
 *                 WHEN ADMIN PAGE LOADING IS FINISHED
 *********************************************************************************************/
 
$(document).ready(function(){


  $("td#Screen_Height").html(window.innerHeight + " px");
  $("td#Screen_Width").html(window.innerWidth + " px");
  $("td#Top_Banner_Height").html($("div#Phobida_TopPanel").height() + " px");
  $("td#Available_Height").html((window.innerHeight - $("div#Phobida_TopPanel").height()) + " px");


  $('td[id^="Pho_Menu"]').hover(
    function() {
      pho_MenuID = $(this).attr('id').substring(8);
      $("table#Pho_SubMenu" + pho_MenuID).show();
    },
    function() {
      pho_MenuID = $(this).attr('id').substring(8);
      $("table#Pho_SubMenu" + pho_MenuID).hide();
    });

});
 
 
 
 