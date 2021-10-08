
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
  
    include 'config.php';
 

  $req = $bdd->prepare('SELECT * FROM membres WHERE pseudo=:pseudo AND pass=:pass');
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

?>