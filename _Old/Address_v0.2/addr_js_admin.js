/* *******************************************************************************************
 *                 INITIALIZE VARIABLES
 ******************************************************************************************* */



/* *******************************************************************************************
 *                 WHEN PAGE LOADING IS FINISHED
 ******************************************************************************************* */
 
$(document).ready(function(){
  
  
  /* *******************************************************************************************
  *                 Admin Addr Item
  ******************************************************************************************* */

  /* init : close all rows except current month */
/*
  $('div[class="ItemNet"]').css("display", "none");
  $('div[class="ItemDesc"]').css("display", "none");
  $('div[class="ItemArea"]').css("display", "none");
  $('div[class="ItemCate"]').css("display", "none");
  var addrItemID   = 0;
*/

  /* expand menu when clicking */
  $('div[id^="AddrName"]').click(function (){
    addrItemID = $(this).attr('id').substring(8);
    if ($("div#AddrItemDesc" + addrItemID).is(":visible")){  /* Checks for display:[none|block], ignores visible:[true|false] */
      $("div#AddrItemDesc" + addrItemID).hide();
      $("div#AddrItemNet" + addrItemID).hide();
      $("div#AddrItemArea" + addrItemID).hide();
      $("div#AddrItemCate" + addrItemID).hide();
    }
    else{
      $("div#AddrItemDesc" + addrItemID).show();
      $("div#AddrItemNet" + addrItemID).show();
      $("div#AddrItemArea" + addrItemID).show();
      $("div#AddrItemCate" + addrItemID).show();
    }

  })

  /* *******************************************************************************************
  *                 Admin Create Addr Item
  ******************************************************************************************* */
  var addrAddItemType     = 0;
  var addrAddItemCate     = 0;
  var addrAddItemCountry  = 0;
  var addrAddItemArea     = 0;
  
  /* if select a addrType */
  $('select#AddrTypeSelect').change(function (){
    addrAddItemType = $(this).children("option:selected").attr('value');
    if (addrAddItemType !== 0){
      $('select#AddrCateSelect').html($("select#AddrCateSelect" + addrAddItemType).html());
    }
    else{
      $('span#AddrCateSelect').html("");
    }
  })
  /* if select a addrCate */
  $('select#AddrCateSelect').change(function (){
    addrAddItemCate = $(this).children("option:selected").attr('value');
    if (addrAddItemCate !== 0){
      $('select#AddrSubCateSelect').html($("select#AddrSubCateSelect" + addrAddItemCate).html());
    }
    else{
      $('span#AddrSubCateSelect').html("");
    }
  })
  
  /* if select a addrCountry */
  $('select#AddrCountrySelect').change(function (){
    addrAddItemCountry = $(this).children("option:selected").attr('value');
    if (addrAddItemCountry !== 0){
      $('select#AddrAreaSelect').html($("select#AddrAreaSelect" + addrAddItemCountry).html());
    }
    else{
      $('span#AddrAreaSelect').html("");
    }
  })
  /* if select a addrArea */
  $('select#AddrAreaSelect').change(function (){
    addrAddItemArea = $(this).children("option:selected").attr('value');
    if (addrAddItemArea !== 0){
      $('select#AddrCitySelect').html($("select#AddrCitySelect" + addrAddItemArea).html());
    }
    else{
      $('span#AddrCitySelect').html("");
    }
  })
  
  /* add another row for description */
  $('p#AddRowDesc').click(function (){
    $('#AddRowDescTable tr:last').before("<tr>" + $("tr#RefAddDesc").html() + "</tr>");
  });
  /* add another row for category */
  $('p#AddRowCate').click(function (){
    $('#AddRowCateTable tr:last').before("<tr>" + $("tr#RefAddCate").html() + "</tr>");
  });
  /* add another row for localization */
  $('p#AddRowCity').click(function (){
    $('#AddRowCityTable tr:last').before("<tr>" + $("tr#RefAddCity").html() + "</tr>");
  });
});




 






 
 
 
 
 
 