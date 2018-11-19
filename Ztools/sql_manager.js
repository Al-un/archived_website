$(document).ready(function(){

  var animationSpeed = 200;

  /* ====================================================== */
  /* ==     if a table name <p> is CLICKED:             === */
  /* ====================================================== */ 
  $('p[id^="SqlTableName"]').click(function(){

    /* retrieve table name */
    strTableName = $(this).attr("id").substring(12);

    if ($("div#SqlTableData"+strTableName).is(":visible")){
      $("div#SqlTableData"+strTableName).slideUp(animationSpeed);
      $("div#SqlTableInfo"+strTableName).slideUp(animationSpeed);
      $("div#SqlTableEntry"+strTableName).slideUp(animationSpeed);
    }
    else{
      $("div#SqlTableData"+strTableName).slideDown(animationSpeed);
      $("div#SqlTableInfo"+strTableName).slideDown(animationSpeed);
      $("div#SqlTableEntry"+strTableName).slideDown(animationSpeed);
    }
  });

  /* ====================================================== */
  /* ==     if an img (more detail icon) is HOVERED:    === */
  /* ====================================================== */ 
  $('p[id^="SqlTableName"]').hover(
    /* mouse in */
    function(){$(this).css('cursor','pointer');},
    /* mouse out */
    function(){$(this).css('cursor','auto');}
  );


  /* ====================================================== */
  /* ==  if a pop up appears, move above left/right div === */
  /* ====================================================== */
  if($("div#Xsy_Sql_Form").length){
    $("div#Xsy_Sql_Modal").html($("div#Xsy_Sql_Form").html());
    $("div#Xsy_Sql_Popup").css('visibility', 'visible');
    $("div#Xsy_Sql_Form").remove();

    var popupWidth  = $("div#Xsy_Sql_Popup").width();
    var popupHeight = $("div#Xsy_Sql_Popup").height();
    var modalWidth  = $("div#Xsy_Sql_Modal").width();
    var modalHeight = $("div#Xsy_Sql_Modal").height();
    $("div#Xsy_Sql_Modal").css( {left:(popupWidth - modalWidth) / 2, top:(popupHeight - modalHeight) / 2});
  }


  /* ====================================================== */
  /* == for manage data with files, main checkbox for all = */
  /* ====================================================== */
  $('#Xsy_Sql_CheckAllFilesCheckboxes').click(function(event){
    if(this.checked) { // check select status
      $('.fileCheckbox').each(function() { //loop through each checkbox
        this.checked = true;  //select all checkboxes with class "checkbox1"               
      });
    }else{
      $('.fileCheckbox').each(function() { //loop through each checkbox
        this.checked = false; //deselect all checkboxes with class "checkbox1"                       
      });
     }
  });


});