<?php


try{
  $bdd = new PDO('mysql:host=localhost;dbname=parisgoairport', 'niklas', '234324423') or die(print_r($bdd->errorInfo()));
  $bdd->exec('SET NAMES UTF8');
  }
  
  catch(Exeption $e){
  die('Erreur:'.$e->getMessage());
  }

?>