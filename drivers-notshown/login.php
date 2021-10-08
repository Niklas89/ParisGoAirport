<?php
session_start();
if(!empty($_SESSION['id']))
{
  header('Location: clients.php');
}

if(!empty($_POST))
{
  $valid = true;
  extract($_POST);
  
  if($valid)
  {
  
    include '../config.php';
 $pass = md5($_POST['pass']);

  $req = $bdd->prepare('SELECT * FROM chauffeurs WHERE pseudo=:pseudo AND pass=:pass');
  $req->execute(array(
    'pseudo'=>$pseudo,
    'pass'=>$pass
  ));
  $data = $req->fetch();
  if($req->rowCount()==0)
  {
    $valid = false;
    $erreurid = 'Mauvais identifiants !';
  }
  

  else
  {
    if($req->rowCount()>0)
    {
      $_SESSION['users'] = $pseudo;
      $_SESSION['id'] = $data['id'];
    }
  }
    
    $req->closeCursor();
    if($valid)
    {
      header('Location: clients.php');
    }
  
  }
}




// if (isset($_POST['submit'])) {
    // Hachage du mot de passe
//     $pass_hache = md5($_POST['pass']);
 //    $pseudo = $_POST['pseudo'];
     
    // Vérification des identifiants
 //    $req = $bdd->prepare('SELECT id FROM membres WHERE pseudo = :pseudo AND pass = :pass');
 //    $req->execute(array(
  //       'pseudo' => $pseudo,
  //       'pass' => $pass_hache));
     
//     $resultat = $req->fetch();
     
//     if (!$resultat)
//     {
 //        header('Location: ../index.php');
 //        exit();
//     }
 //    else
 //    {
 //        session_start();
 //        $_SESSION['id'] = $resultat['id'];
 //        $id_users = $_SESSION['id'];
// 		header('Location: ../tours.php');
		
 //    }
// } // end if isset post submit

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<!--META-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Form</title>

<!--STYLESHEETS-->
<link href="css/style.css" rel="stylesheet" type="text/css" />

<!--SCRIPTS-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<!--Slider-in icons-->
<script type="text/javascript">
$(document).ready(function() {
	$(".username").focus(function() {
		$(".user-icon").css("left","-48px");
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","0px");
	});
	
	$(".password").focus(function() {
		$(".pass-icon").css("left","-48px");
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","0px");
	});
});
</script>

</head>
<body>

<!--WRAPPER-->
<div id="wrapper">

	<!--SLIDE-IN ICONS-->
    <div class="user-icon"></div>
    <div class="pass-icon"></div>
    <!--END SLIDE-IN ICONS-->

<!--LOGIN FORM-->
<form name="login-form" class="login-form" action="login.php" method="post">

	<!--HEADER-->
    <div class="header">
    <!--TITLE--><h1>Login Form</h1><!--END TITLE-->
    <!--DESCRIPTION--><span>Admin area - manage clients</span><!--END DESCRIPTION-->
    <?php if(isset($ok)){ echo '<h3 id="ok">'.$ok.'</h3>';} 
            elseif(isset($erreurid)){ ?>
            
              <?php echo '<h3 id="erreurid">'.$erreurid.'</h3>'; } ?>
    </div>
    <!--END HEADER-->
	
	<!--CONTENT-->
    <div class="content">
	<!--USERNAME--><input name="pseudo" type="text" class="input username" value="Username" onfocus="this.value=''" /><!--END USERNAME-->
    <!--PASSWORD--><input name="pass" type="password" class="input password" value="Password" onfocus="this.value=''" /><!--END PASSWORD-->
    </div>
    <!--END CONTENT-->
    
    <!--FOOTER-->
    <div class="footer">
    <!--LOGIN BUTTON--><input type="submit" name="submit" value="Login" class="button" /><!--END LOGIN BUTTON-->
    <!--REGISTER BUTTON <input type="submit" name="submit" value="Register" class="register" /> END REGISTER BUTTON-->
    </div>
    <!--END FOOTER-->

</form>
<!--END LOGIN FORM-->

</div>
<!--END WRAPPER-->

<!--GRADIENT--><div class="gradient"></div><!--END GRADIENT-->

</body>
</html>

