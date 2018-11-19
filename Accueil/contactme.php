<?php
// =================================  FEEDBACK OR CONTACT AREA ============================== //
	
// -----  PHP FORM TREATMENT 
if (isset($_POST['submitMail'])) {

  $email    = get("email");
  $subject  = get("subject");
  $message  = get("message");
  $cc       = get("cc");

  if ($cc == "yes") {
    sendMail($subject, $message, "Home Page Contact Form (Copy)", $email, $email, $email);
  }

  if (sendMail($subject, $message, "Home Page Contact Form", $_SESSION['adminmail'], $email, $email)) {

    switch($_SESSION['userlang']) {
      case "Fr" :
        $rvcdMsg = "<script type = 'text/javascript'>alert('Message envoyé, Merci!');</script>";
		  break;
      case "En" :
        $rvcdMsg = "<script type = 'text/javascript'>alert('Message Sent. Thank you!');</script>";
        break; 
      case "ZhTr":
        $rvcdMsg = "<script type = 'text/javascript'>alert('正確地發送消息,謝謝');</script>";
        break; 
      default : 
        $rvcdMsg = "<script type = 'text/javascript'>alert('Message Sent. Thank you! \n Error in language:".$_SESSION['userlang']."');</script>";
    }
	
	echo $rvcdMsg;
  }
}
	
// ---------- MULTI LANG
switch($_SESSION['userlang']){
    case "Fr":
      $feedbackTitle    = "Me Contacter";
      $feedbackEmail    = "Email";
      $feedbackSubject  = "Objet";
      $feedbackCc       = "Recevoir une copie";
      $feedbackCcYes    = "Oui";
      $feedbackCcNo     = "Non";
      $feedbackMessage  = "Message";
	  $feedbackMsgInput = "(Entrez votre message)";
      $feedbackSubmit   = "Envoyer";
      break;
    case "En":
      $feedbackTitle    = "Contact Me";
      $feedbackEmail    = "Email";
      $feedbackSubject  = "Subject";
      $feedbackCc       = "I want a copy";
      $feedbackCcYes    = "Yes";
      $feedbackCcNo     = "No";
      $feedbackMessage  = "Content";
	  $feedbackMsgInput = "(Message content)";
      $feedbackSubmit   = "Send";
      break; 
    case "ZhTr":
      $feedbackTitle    = "聯絡我";
      $feedbackEmail    = "電子郵件";
      $feedbackSubject  = "主題";
      $feedbackCc       = "I want to receive a copy";
      $feedbackCcYes    = "Yes";
      $feedbackCcNo     = "No";
      $feedbackMessage  = "內容";
	  $feedbackMsgInput = "()";
      $feedbackSubmit   = "發送";
      break; 
    default : 
      echo("<p>Wrong Language input : ".$_SESSION['userlang'].'</p>');
      $feedbackEmail    = "email";
      $feedbackSubject  = "subject";
      $feedbackCc       = "I want a copy";
      $feedbackCcYes    = "yes";
      $feedbackCcNo     = "no";
      $feedbackMessage  = "content";
	  $feedbackMsgInput = "(message content)";
      $feedbackSubmit   = "send";
 }
  
// -------------- DISPLAY THE FORM
echo("
<div id = 'contactme'>
  <h2> $feedbackTitle </h2>
  
  <form method = 'post' action = '".$_SERVER['PHP_SELF']."' id = 'contactme'>
	<table>
	  <tr> 
		  <td> $feedbackEmail </td>
		  <td> <input type = 'text' name = 'email' style = 'width:400px;' value='".$_SESSION['usermail']."'/> </td>
	  </tr>
    <tr>
		  <td> $feedbackSubject </td>
		  <td> <input type = 'text' name = 'subject' style = 'width:400px;'  /> </td>
	  </tr>
	  <tr>
		  <td> $feedbackCc </td>
		  <td style = 'text-indent: 15px;'> <input type = 'radio' name = 'cc' value = 'yes' />       $feedbackCcYes &nbsp; 
           <input type = 'radio' name = 'cc' value = 'no' checked/> $feedbackCcNo</td>
	  </tr>
    <tr> 
		  <td> $feedbackMessage</td>
		  <td> <textarea name = 'message' style = 'width:400px; height:200px; font-size:small; font-style:italic;'>$feedbackMsgInput</textarea></td>
	  </tr>
	  <tr> 
		  <td></td>
		  <td> <input type = 'submit' name = 'submitMail' value = '$feedbackSubmit' class = 'contactsubmit'/> </td>
	  </tr>
	</table>
  </form>
</div>
");
 
 ?>