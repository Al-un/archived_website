<?php
// ========================================================================================
// SQL
// ========================================================================================

// ==================================== SQL CONNECTION ============================ //
// initialize variables
$XSY_SQL_PDO = null;

// define value according to http_host
if ($_SERVER['HTTP_HOST'] == "localhost" OR (stristr($_SERVER['HTTP_HOST'], "192.168.") !== FALSE)){  
  $website      = "http://Localhost/";
  $SQL_SERVER   = "localhost";
  $SQL_USER     = "root";
  $SQL_PASSWORD = "";
  $SQL_DATABASE = "freeh_taetili";
  $zToolsRoot   = "";
}
elseif ($_SERVER['HTTP_HOST'] == "xsylum.free-h.net"){  
  $website      = "http://xsylum.free-h.net/";
  $SQL_SERVER   = "sql31.free-h.org";
  $SQL_USER     = "XsyDbUser";
  $SQL_PASSWORD = "32Hakur3i@Sql!";
  $SQL_DATABASE = "xsylum";
  $zToolsRoot   = "";
}
elseif ( ($_SERVER['HTTP_HOST'] == "xsylum.fr") OR (stristr($_SERVER['HTTP_HOST'], ".xsylum.fr") !== FALSE)){  
  $website      = "http://xsylum.fr";
  $subdomain    = stristr($_SERVER['HTTP_HOST'], ".xsylum.fr", TRUE);
  $SQL_SERVER   = "localhost";
  $SQL_USER     = "xsylumfr_XsyDB";
  $SQL_PASSWORD = "Marisa63@SqlDb!";
  // $SQL_USER     = "xsylumfr";
  // $SQL_PASSWORD = "";
  $SQL_DATABASE = "xsylumfr_main";
  $zToolsRoot   = "http://xsylum.fr";
}


// ==================================== All* TABLES ================================ //
$sqlTable_all_minisites   = "all_Minisites";
$sqlTable_all_users       = "all_Users";
$sqlTable_all_languages   = "all_Languages";
$sqlTable_all_auths       = "all_Auths";
$sqlTable_all_sitelang    = "all_SiteLang";
$sqlTable_all_siteuser    = "all_SiteUser";
$sqlTable_all_sitedesc    = "all_SiteDesc";
$sqlTable_all_siteupd     = "all_SiteUpdate";

// $sqlTable_all_updates     = "all_update";
// $sqlTable_pic_folder      = "all_picfolder";
// $sqlTable_all_captcha     = "all_captcha";
// $sqlTable_fav_cate        = "Fav%cate";
// $sqlTable_fav_item        = "Fav%item";
// $sqlTable_remind_cate     = "Remind%cate";
// $sqlTable_remind_item     = "Remind%item";


// ==============================================================
// Session related global variables
// ==============================================================
$XSY_GLOB_DEFAULTUSERID   = 1;
$XSY_SESS_NORMALLEVEL     = 1;
$XSY_SESS_USERLEVEL       = 2;
$XSY_SESS_SUPERUSERLEVEL  = 3;
$XSY_SESS_ADMINLEVEL      = 4;


// ==============================================================
// Timezone
// ==============================================================
date_default_timezone_set("Europe/Paris");
?>