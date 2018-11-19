
  var missing_color = "red";
  var error_color = "DarkRed";
  var ok_color = "green";
  
  function check_register(){
    
  var formulaire = document.forms[1];
    
    for (var i = 0; i <= 3; i++){
     
      var item = formulaire.elements[i];
      /* check if a field is empty */
      if ( item.value == ""){
        item.style.backgroundColor = missing_color;
        item.focus();
        return false;
      }
      else{
        item.style.backgroundColor = ok_color;
      }
      
      /* check the email */
      if ( i == 3 && item.value != ""){
        var pattern = new RegExp("^([a-zA-Z0-9-_\.])+@([a-zA-Z0-9-]+\.)+[a-z]{2,3}$");
        if ( item.value.match(pattern) ){
           item.style.backgroundColor = ok_color;
        }
        else{
          alert(' Email non reconnu. Contactez l\'administrateur en cas de problème ');
          item.style.backgroundColor = error_color;
          item.focus();
          item.select();
          return false;
        }
      }
        
    } // enf for()
    
  return true;
  }

  function check_password( oldpassword ){
    
    var formulaire = document.forms[2];  
    
    /* check if old passwords are the same */
    var oldpwd = formulaire.elements[0];
    if (oldpwd.value != oldpassword){
      alert("L'ancien mot de passe est incorrect");
      oldpwd.style.backgroundColor = error_color;
      oldpwd.focus();
      oldpwd.select();
      return false;
    }
    else{
      oldpwd.style.backgroundColor = ok_color;
    }
    
    /* check the new one */
    var pwd1 = formulaire.elements[1];
    var pwd1value = pwd1.value;
    var pwd2 = formulaire.elements[2];
    var pwd2value = pwd2.value;
    /* need both fields not empty */
    if (pwd1value != "" && pwd2value != ""){
       /* check if they are equals */
      if (pwd1value != pwd2value){
         pwd1.style.backgroundColor = error_color;
        pwd2.style.backgroundColor = error_color;
        alert('Les deux mots de passe ne concordent pas!');
        pwd1.focus();
        pwd2.select();
        return false;
      }
      else{
        pwd1.style.backgroundColor = ok_color;
        pwd2.style.backgroundColor = ok_color;
      }
    }
    /* first one empty */
    else if (pwd1value == ""){
      alert("Le premier mot de passe est vide !");
      pwd1.style.backgroundColor = missing_color;
      pwd1.focus();
      return false;
    }
    /* second one is empty */
    else if (pwd2value == ""){
      alert("Le second mot de passe est vide !");
      pwd2.style.backgroundColor = missing_color;
      pwd2.focus();
      return false;
    }
    
    return true;
  }