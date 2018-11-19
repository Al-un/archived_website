/* *******************************************************************************************
 *                 INITIALIZE VARIABLES
 ******************************************************************************************* */
var oldExcelId = -1;
var newExcelId = -1;

$(document).ready(function(){

  $("div#ExcelDesc-1").show();

  $("input[name='excelFiles']").click(function(){
    newExcelId = $(this).attr('id').substring(5);
    $("div#ExcelDesc"+oldExcelId).hide();
    $("div#ExcelDesc"+newExcelId).show();
    oldExcelId = newExcelId;
  });

  $("div#Summary div").click(function(){
    $("div#Xsy_Glob_Page div.plop").hide();
    $("div#"+$(this).attr('id')+"Block").show();

  });

});




 






 
 
 
 
 
 