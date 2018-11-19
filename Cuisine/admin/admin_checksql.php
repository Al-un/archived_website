<?php
include('../tools/header.php');
include('../../Ztools/sql_manager.php');  
  
$allSqlTable;
$allSqlContent;
$allSqlDefine;
 
$allSqlTable[]	= $table_cuisineRecette; 
$allSqlTable[]	= $table_cuisineIngredient;
$allSqlTable[]	= $table_cuisineCate;
$allSqlTable[]	= $table_cuisineMateriel;
$allSqlTable[]	= $table_cuisineComm;
$allSqlTable[]	= $table_cuisinePhoto;
$allSqlTable[]	= $table_cuisineCateRecette;
$allSqlTable[]	= $table_cuisineRecetteIngre;
$allSqlTable[]	= $table_cuisineRecetteMatos;
$allSqlTable[]	= $table_cuisineIngreCate;
$allSqlTable[]	= $table_cuisineCateIngre;

/********************************************************************************************************/
/*						 SQL TABLE DEFINITION 															
/********************************************************************************************************/


$allSqlContent[0] = "CREATE TABLE IF NOT EXISTS `$SQL_DATABASE`.`".$allSqlTable[0]."` (
        `ID_CuisineRecette` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(ID_CuisineRecette),
		`Author` VARCHAR(50),
		`Recette%Name` VARCHAR(70),
		`Recette` VARCHAR(1000),
		`Temps` VARCHAR(15),
		`UpDT_datetime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
$allSqlContent[1] = "CREATE TABLE IF NOT EXISTS `$SQL_DATABASE`.`".$allSqlTable[1]."` (
        `ID_CuisineIngredient` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
        PRIMARY KEY(ID_CuisineIngredient),
        `Ingredient%Name` VARCHAR(50) )";
$allSqlContent[2] = "CREATE TABLE IF NOT EXISTS `$SQL_DATABASE`.`".$allSqlTable[2]."` (
        `ID_CuisineCate` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(ID_CuisineCate),
		`Category%Name` VARCHAR(50),
		`Order` TINYINT)";
$allSqlContent[3] = "CREATE TABLE IF NOT EXISTS `$SQL_DATABASE`.`".$allSqlTable[3]."` (
        `ID_CuisineMateriel` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(ID_CuisineMateriel),
		`Materiel%Name` VARCHAR(50))";
$allSqlContent[4] = "CREATE TABLE IF NOT EXISTS `$SQL_DATABASE`.`".$allSqlTable[4]."` (
		`ID_CuisineComm` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(ID_CuisineComm),
		`id_CuisineRecette` SMALLINT,
		`Id_MainComm` SMALLINT,
		`Author` VARCHAR(50),
		`Email` VARCHAR(100), 
		`Date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`Comment` VARCHAR(500))";
$allSqlContent[5] = "CREATE TABLE IF NOT EXISTS `$SQL_DATABASE`.`".$allSqlTable[5]."` (
		`ID_CuisinePhoto` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(ID_CuisinePhoto),
		`id_CuisineRecette` SMALLINT,
		`UrlImg%Photo` VARCHAR(50))";	
$allSqlContent[6] = "CREATE TABLE IF NOT EXISTS `$SQL_DATABASE`.`".$allSqlTable[6]."` (
        `ID_CuisineCateRecette` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(ID_CuisineCateRecette),
		`id_CuisineCate` SMALLINT,
		`id_CuisineRecette` SMALLINT)";
$allSqlContent[7] = "CREATE TABLE IF NOT EXISTS `$SQL_DATABASE`.`".$allSqlTable[7]."` (
		`ID_CuisineRecetteIngre` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(ID_CuisineRecetteIngre),
		`id_CuisineRecette` SMALLINT,
		`id_CuisineIngredient` SMALLINT,
		`Ingredient%Quantity` VARCHAR(15))";
$allSqlContent[8] = "CREATE TABLE IF NOT EXISTS `$SQL_DATABASE`.`".$allSqlTable[8]."` (
		`ID_CuisineRecetteMatos` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(ID_CuisineRecetteMatos),
		`id_CuisineRecette` SMALLINT,
		`id_CuisineMateriel` SMALLINT,
		`Matos%Quantity` VARCHAR(15))";	
$allSqlContent[9] = "CREATE TABLE IF NOT EXISTS `$SQL_DATABASE`.`".$allSqlTable[9]."` (
		`ID_CuisineIngreCate` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(ID_CuisineIngreCate),
		`Ingredient%Category%Name` VARCHAR(60))";
$allSqlContent[10] = "CREATE TABLE IF NOT EXISTS `$SQL_DATABASE`.`".$allSqlTable[10]."` (
		`ID_CuisineCateIngre` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(ID_CuisineCateIngre),
		`id_CuisineIngreCate` SMALLINT,
		`id_CuisineIngredient` SMALLINT)";			
		
/********************************************************************************************************/
/*						 SQL TABLE CONTENT 															
/********************************************************************************************************/	


$allSqlDefine[0][] = "";

$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('1', 'Tomate')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('2', 'Courgette')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('3', 'Aubergine')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('4', 'Pomme de Terre')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('5', 'Concombre')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('6', 'Oignon')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('7', 'Echalotte')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('8', 'Ail')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('9', 'Porc (Côte)')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('10', 'Porc (Poitrine)')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('11', 'Boeuf (Côte)')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('12', 'Poulet (Cuisse)')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('13', 'Dinde (Filet)')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('14', 'Canard (Magret)')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('15', 'Nuoc-Mâm')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('16', 'Sauce d\'Huître')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('17', 'Sauce de Soja')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('18', 'Huile d\'Olive')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('19', 'Huile de Tournesol')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('20', 'Huile de Sésame')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('21', 'Pomme')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('22', 'Pruneau')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('23', 'Abricot')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('24', 'Curry (Jaune)')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('25', 'Curcuma')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('26', 'Curry (Rouge)')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('27', 'Saté')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('28', 'Concombre')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('29', 'Chou blanc')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('30', 'Chou fleur')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('31', 'Carotte')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('32', 'Citron')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('33', 'Orange')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('34', 'Mandarine')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('35', 'Pamplemousse')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('36', 'Pomelo')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('37', 'Clémentine')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('38', '小白菜')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('39', 'Brocoli')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('40', 'Mangue')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('41', 'Fruit du Jacquier (菠蘿蜜)')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('42', 'Litchi (荔枝)')";
$allSqlDefine[1][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[1]."` VALUES('43', 'Longan (龍眼)')";

$allSqlDefine[2][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[2]."` VALUES(NULL, 'Cuisine Européenne', '1')";
$allSqlDefine[2][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[2]."` VALUES(NULL, 'Cuisine Asiatique', '2')";

$allSqlDefine[3][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[3]."` VALUES(NULL, 'Fait-tout')";
$allSqlDefine[3][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[3]."` VALUES(NULL, 'Auto-cuiseur')";
$allSqlDefine[3][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[3]."` VALUES(NULL, 'Spatule')";
$allSqlDefine[3][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[3]."` VALUES(NULL, 'Cuillère')";
$allSqlDefine[3][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[3]."` VALUES(NULL, 'Fourchette')";
$allSqlDefine[3][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[3]."` VALUES(NULL, 'Couteau (gros)')";
$allSqlDefine[3][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[3]."` VALUES(NULL, 'Couteau (petit)')";
$allSqlDefine[3][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[3]."` VALUES(NULL, 'Econome')";
$allSqlDefine[3][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[3]."` VALUES(NULL, 'Casserole')";
$allSqlDefine[3][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[3]."` VALUES(NULL, 'Po&ecirc;le')";
$allSqlDefine[3][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[3]."` VALUES(NULL, 'Bol')";
$allSqlDefine[3][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[3]."` VALUES(NULL, 'Assiette')";
$allSqlDefine[3][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[3]."` VALUES(NULL, 'Baguette (bois)')";
$allSqlDefine[3][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[3]."` VALUES(NULL, 'Baguette')";

$allSqlDefine[4][] = "";
$allSqlDefine[5][] = "";
$allSqlDefine[6][] = "";
$allSqlDefine[7][] = "";
$allSqlDefine[8][] = "";

$allSqlDefine[9][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[9]."` VALUES('1', 'Légumes')";
$allSqlDefine[9][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[9]."` VALUES('2', 'Légumes Feuilles')";
$allSqlDefine[9][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[9]."` VALUES('3', 'Légumes Fines Herbes')";
$allSqlDefine[9][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[9]."` VALUES('4', 'Fruits')";
$allSqlDefine[9][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[9]."` VALUES('5', 'Fruits sec')";
$allSqlDefine[9][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[9]."` VALUES('6', 'Viande Blanche')";
$allSqlDefine[9][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[9]."` VALUES('7', 'Viande Rouge')";
$allSqlDefine[9][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[9]."` VALUES('8', 'Viande Volaille')";
$allSqlDefine[9][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[9]."` VALUES('9', 'Légumes Tiges')";
$allSqlDefine[9][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[9]."` VALUES('10', 'Epice')";
$allSqlDefine[9][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[9]."` VALUES('11', 'Sauce')";
$allSqlDefine[9][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[9]."` VALUES('12', 'Huile')";
$allSqlDefine[9][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[9]."` VALUES('13', 'Agrume')";
$allSqlDefine[9][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[9]."` VALUES('14', 'Légumes Chinois')";

$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '1', '1')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '1', '2')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '1', '3')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '1', '4')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '1', '5')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '9', '6')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '9', '7')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '9', '8')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '6', '9')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '6', '10')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '7', '11')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '8', '12')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '8', '13')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '7', '14')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '11', '15')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '11', '16')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '11', '17')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '12', '18')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '12', '19')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '12', '20')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '4', '21')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '4', '22')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '4', '23')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '10', '24')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '10', '25')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '10', '26')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '10', '27')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '1', '28')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '2', '29')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '2', '30')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '1', '31')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '13', '32')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '13', '33')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '13', '34')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '13', '35')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '13', '36')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '13', '37')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '14', '38')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '1', '39')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '4', '40')";
$allSqlDefine[10][] = "INSERT INTO `$SQL_DATABASE`.`".$allSqlTable[10]."` VALUES(NULL, '4', '41')";



echo("<div style='z-index:2;background:black;margin:auto;width:80%;'>");
sqlManage($allSqlTable,$allSqlContent,$allSqlDefine);
echo("</div>");

include('../tools/footer.php');
?>