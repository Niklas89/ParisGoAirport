<?php 
session_start();
if(!empty($_SESSION['id']))
{
  header('Location: clients.php');
}
else {
  header('Location: login.php');
}
  ?>