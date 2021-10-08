<?php if(!empty($_POST))
{
  $valid = true;
  extract($_POST);
  
  if($valid)
  {
  
    include '../config.php';
 $pass = md5($_POST['pass']);

  $req = $bdd->prepare('SELECT * FROM membres WHERE pseudo=:pseudo AND pass=:pass');
  $req->execute(array(
    'pseudo'=>$pseudo,
    'pass'=>$pass
  ));
  $data = $req->fetch();
  if($req->rowCount()==0)
  {
    $valid = false;
    // $erreurid = 'Mauvais identifiants !';
	echo 'Wrong username or password !';
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
?>