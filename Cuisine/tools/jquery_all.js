$(document).ready(function(){

  // =============================================================== //
  // ====              ADD INGREDIENT FROM LIST                  === //
  // =============================================================== //
  $("p#AddIngredient").click(function() {
    $("select#IngredientSelect option:selected").each(function () {
	  if($('input[name="ingredient'+$(this).val()+'"]').length == 0){
        $("div#IngredientField > table").append(
		  "<tr id='ingredient"+ $(this).val() + "'>" +
		  "<td><input type='checkbox' name='ingredientToDelete' value='"+$(this).val()+"' /></td>" + 
		  "<td><input type='text'     name='ingredient"+$(this).val() + "' size='1' maxlength='15' /></td>"+
		  "<td>"+$(this).text()+"</td>"+
		  "<input type='hidden'   name='ingredientId[]' value='"+$(this).val()+"' />"+
		  "</tr>");
	  }
	  $(this).attr("selected", "");
    });
  });
 
  // =============================================================== //
  // ====                ADD MATERIEL FROM LIST                  === //
  // =============================================================== // 
   $("p#AddMateriel").click(function() {
    $("select#MaterielSelect option:selected").each(function () {
	  if($('input[name="materiel'+$(this).val()+'"]').length == 0){
        $("div#MaterielField > table").append(
		  "<tr id='materiel"+ $(this).val() + "'>" +
		  "<td><input type='checkbox' name='materielToDelete' value='"+$(this).val()+"' /></td>" + 
		  "<td><input type='text'     name='materiel"+$(this).val() + "' size='1' maxlength='15' /></td>"+
		  "<td>"+$(this).text()+"</td>"+
		  "<input type='hidden'   name='materielId[]' value='"+$(this).val()+"' />"+
		  "</tr>");
	  }
	  $(this).attr("selected", "");
	});
  }); 

  
  // =============================================================== //
  // ====           DELETE INGREDIENT FROM LIST                  === //
  // =============================================================== //
  $("p#DeleteIngredient").click(function() {
	$("input[name=ingredientToDelete]").each(function (){
	  if ($(this).attr('checked') == true){
	    $("tr#ingredient"+$(this).val()).remove();
	  }
	});
  });
 
  // =============================================================== //
  // ====             DELETE MATERIEL FROM LIST                  === //
  // =============================================================== // 
   $("p#DeleteMateriel").click(function() {
	$("input[name=materielToDelete]").each(function (){
	  if ($(this).attr('checked') == true){
	    $("tr#materiel"+$(this).val()).remove();
	  }
	});
  }); 
});
 
 
 
 
 
 