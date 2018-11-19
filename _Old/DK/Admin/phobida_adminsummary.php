<?php
  // ======================================================================================== //
  // >>>>>>>>>>>>>>>>>>>>>>           Left Panel
  // ======================================================================================== //


  
// if admin, display administration panel
if ($_SESSION['useradmin']){
  echo("
  <table>
   <tr>

   <td class='menu' id='Pho_Menu1'> Phobida Management
    <table class='submenu'  id='Pho_SubMenu1'>
      <tr> <td> <a href='".$urlPhoMngtMenu."'>   ".$contentPhoMngtMenu."  </a> </td> </tr>
      <tr> <td> <a href='".$urlPhoMngtPhoto."'>  ".$contentPhoMngtPhoto."  </a> </td> </tr>
    </table>
   </td>

   <td class='menu' id='Pho_Menu2'> Sql Tables
    <table class='submenu'  id='Pho_SubMenu2'>
     <tr> <td> <a href='".$urlSqlMenuItem."'>     ".$sqlPho_MenuItem."  </a> </td> </tr>
     <tr> <td> <a href='".$urlSqlMenuCate."'>     ".$sqlPho_MenuCate."  </a> </td> </tr>
     <!-- <tr> <td> <a href='".$urlSqlMenuRating."'>".$sqlPho_MenuRating."  </a> </td> </tr> -->
     <tr> <td> <a href='".$urlSqlMenuCateItem."'> ".$sqlPho_MenuCateItem."  </a> </td> </tr>
     <tr> <td> <a href='".$urlSqlPhoto."'>        ".$sqlPho_Photo."  </a> </td> </tr>
    </table>
   </td>

   <td class='menu' id='Pho_Menu3'> Technical Links
    <table class='submenu'  id='Pho_SubMenu3'>
     <tr> <td> <a href='".$urlTechnicalInfo."'>         ".$contentTechnicalInfo."  </a> </td> </tr>
     <tr> <td> <a href='".$urlSqlMngt."'>         ".$contentSqlMngt."  </a> </td> </tr>
     <tr> <td> <a href='".$urlSqlDirectSql."'>    ".$contentSqlDirectSql."  </a> </td> </tr>
     <tr> <td> <a href='".$urlSqlUserAccount."'>    ".$contentSqlUserAccount."  </a> </td> </tr>
    </table>
   </td>
   </tr>
  </table>
");
}  
?>