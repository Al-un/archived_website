<?php
  include('../tools/header.php');
?>
  <a href='admin_index.php'>Retour Admin Index</a><br />
<?php
  // ============================ CHECK ALL SQL TABLES ==================================== // 
  

   
  $existCategorie	= checkExistingSqlTable('cuisine_categorie');
  $existRecette		= checkExistingSqlTable('cuisine_recette');
  $existIngredient	= checkExistingSqlTable('cuisine_ingredient');
  $existMateriel	= checkExistingSqlTable('cuisine_materiel');
  $existCommentaire	= checkExistingSqlTable('cuisine_commentaire');
  $existPhoto		= checkExistingSqlTable('cuisine_photo');
  
  if ($existCategorie == 0) {
    echo('<p> need to create categorie</p>');
  }
  if ($existRecette == 0) {
    echo('<p> need to create recette</p>');
  }
  if ($existIngredient == 0) {
    echo('<p> need to create ingredient</p>');
  }
  if ($existMateriel == 0) {
    echo('<p> need to create materiel</p>');
  }
  if ($existCommentaire == 0) {
    echo('<p> need to create commentaire</p>');
  }
  if ($existPhoto == 0) {
    echo('<p> need to create photo</p>');
  }

  include('../tools/footer.php');
?>