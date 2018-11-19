<?php
include('../tools/header.php');
include('../../Ztools/sql_manager.php');  
  
$allSqlTable;
$allSqlContent;
$allSqlDefine;  


$allSqlTable[6] = $table_HK_StoryItem;
$allSqlTable[1] = $table_HK_StoryCate;
$allSqlTable[2] = $table_HK_StoryComm;
$allSqlTable[3] = $table_HK_StoryPhoto;
$allSqlTable[4] = $table_HK_Background;
$allSqlTable[5] = $table_HK_Comment;

$allSqlContent[6] = "CREATE TABLE  `$SQL_DATABASE`.`".$allSqlTable[6]."` (
    `Id_StoryItem` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(Id_StoryItem),
    `id_StoryCate` TINYINT UNSIGNED NOT NULL,
    `Name_Title` VARCHAR(75) UNIQUE,
    `Txt_content` VARCHAR(1000),
    `Update_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP )";
$allSqlContent[1] = "CREATE TABLE  `$SQL_DATABASE`.`".$allSqlTable[1]."` (
    `Id_StoryCate` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(Id_StoryCate),
    `Cate%Name` VARCHAR(50))";
$allSqlContent[2] = "CREATE TABLE  `$SQL_DATABASE`.`".$allSqlTable[2]."` (
    `Id_StoryComm` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(Id_StoryComm),
		`id_StoryItem` SMALLINT UNSIGNED,
		`Author` VARCHAR(50),
		`Txt_Comment` VARCHAR(500),
		`Update_Date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP )";
$allSqlContent[3] = "CREATE TABLE  `$SQL_DATABASE`.`".$allSqlTable[3]."` (
		`Id_StoryPhoto` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(Id_StoryPhoto),
		`id_StoryItem` SMALLINT UNSIGNED,
		`UrlImgHK_Photo` VARCHAR(50);
    `Title` VARCHAR(75))";
$allSqlContent[4] = "CREATE TABLE  `$SQL_DATABASE`.`".$allSqlTable[4]."` (
    `Id_Background` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(Id_background),
    `UrlImgHK_Background` VARCHAR (50),
    `Place` VARCHAR (50),
    `Description` VARCHAR (100) )";
$allSqlContent[5] = "CREATE TABLE  `$SQL_DATABASE`.`".$allSqlTable[5]."` (
    `Id_Comment` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(id_hkcomment),
    `author` VARCHAR(50),
    `comment` VARCHAR(500),
    `datetime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP )";
	  
$allSqlDefine[6][] = '';
$allSqlDefine[1][] = '';
$allSqlDefine[2][] = '';
$allSqlDefine[3][] = "INSERT INTO `$SQL_DATABASE`.`$table_pic_folder` VALUES (NULL, 'UrlImgHK_Photo','/HongKong/Stories/tof/')";
$allSqlDefine[4][] = "INSERT INTO `$SQL_DATABASE`.`$table_pic_folder` VALUES (NULL, 'UrlImgHK_Background','/HongKong/Background/')";
$allSqlDefine[5][] = '';
	

  sqlManage($allSqlTable,$allSqlContent,$allSqlDefine);	

  include('../tools/footer.php');
?>