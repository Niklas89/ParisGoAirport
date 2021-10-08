<?php

session_start();
$id_users = $_SESSION['id'];

if(empty($_SESSION['id']))
{
  header('Location: login.php');
  exit();
}

include '../config.php';

  if (isset($_GET['del'])) // Si on demande de supprimer une news
{
    // Alors on supprime la news correspondante
    // On protège la variable "id_news" pour éviter une faille SQL
    $_GET['del'] = addslashes($_GET['del']);
    $id = $_GET['del'];

    $req = $bdd->prepare('DELETE FROM personnes WHERE id=:id');
    $req->execute(array(
      'id'=>$id
    ));
    $req->closeCursor();
  
}


if(!empty($_POST))
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
      $ok = 'Connected !';
    }
  
  }
}



?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Paris Airport - Clients</title>

        <meta name="description" content="Paris Airport Transfers. Private and Shared shuttles: free reservation - pay the driver directly.">
        <meta name="keywords" content="paris airport transfer,paris airport shuttle,paris cdg shuttle,paris orly shuttle,paris beauvais shuttle">
        <meta name="author" content="Niklas Edelstam">
        <meta name="robots" content="index,follow" />
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="../css/normalize.min.css">
        <link rel="stylesheet" href="../css/main.css">
        
        <link rel="icon" type="image/png" href="../img/icons/favicon.png" />
        <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="img/icons/favicon.ico" /><![endif]-->
        <link rel="apple-touch-icon" href="../img/icons/apple-touch-icon-57x57.png" /> 
        <link rel="apple-touch-icon" sizes="72x72" href="../img/icons/apple-touch-icon-72x72" /> 
        <link rel="apple-touch-icon" sizes="114x114" href="../img/icons/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="../img/icons/apple-touch-icon-144x144.png" />

        <script src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div class="header-container">
            <header class="wrapper clearfix">
                <h1 class="title"><a href="../index.php" title="ParisGOairport"><span class="airport">PARIS</span><span class="go">GO</span><span class="airport">AIRPORT</span></a></h1>
               <!-- <nav>
                    <ul>
                        <li><a href="#">nav ul li a</a></li>
                        <li><a href="#">nav ul li a</a></li>
                        <li><a href="#">nav ul li a</a></li>
                    </ul>
                </nav> -->
            </header>
        </div> 

        <div class="main-container">
            <div class="main wrapper clearfix">
              <div class="paddingdiv">
                <div id="logout"><p><a href="logout.php" title="Logout"><img src="../img/icons/logout.png" alt="logout" /></a></p></div>
                <h2>Paris - Airport Clients <?php echo $_SESSION['id']; ?></h2>
                <p class="main-description">Clients Paris - Orly - CDG - Beauvais</p>
				<?php if(isset($ok)){ echo '<h3 id="ok">'.$ok.'</h3>';}  ?>

                
              <table>
                
                     <?php 
                              $resultats=$bdd->query('SELECT * FROM personnes ORDER BY coldate DESC');
                              $resultats->setFetchMode(PDO::FETCH_OBJ);
                              while( $resultat = $resultats->fetch() )
                              { ?>
                                          
                                        <tr>
                                           <th><a href="clientprofile.php?id=<?php echo $resultat->id; ?>" title="Client" class="lien-ficheclient"><?php echo $resultat->firstname; ?> <?php echo $resultat->lastname; ?></a></th>
                                           <?php
                                            echo '<td><span class="clients-date">'.date('H:i:s \- jS \o\f F Y', strtotime($resultat->coldate)).'</span></td>';
                                            echo '<td><a href="clientprofile.php?id='.$resultat->id.'" title="Client" class="lien-ficheclient">'.$resultat->way.' '.$resultat->tfairport.' '.$resultat->airport.' '.$resultat->location.'</a></td>';
                                           ?>
                                           <td><a href="clients.php?del=<?php echo $resultat->id; ?>" title="Delete" class="delete-client">Delete</a></td>
                                       </tr>

                                      <?php 
                              }
                              $resultats->closeCursor();

                              ?> 
            </table>
              </div>
            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
              <div class="paddingdiv">
               <div class="contacticon"><a href="../contact.php" title="Contact us" class="contactlink">Contact</a></div>
              <div class="homeicon"><a href="../index.php" title="Home" class="homelink">Home</a></div>
              <div class="toursicon"><a href="../tours.php" title="Sightseeing Tours" class="tourslink">Sightseeing</a></div>
            </div>
            </footer>

                <div id="socialfooter">
                <div class="fbicon"><a href="https://www.facebook.com/parisgoairport" title="Like us on Facebook" class="fblink" target="_blank"></a></div>
                <div class="twittericon"><a href="https://twitter.com/ParisGoAirport" title="Follow us on Twitter" class="twitterlink" target="_blank"></a></div>
                <div class="blogicon"><a href="../blog" title="Blog" class="bloglink" target="_blank"></a></div>
                <!--<div id="langfooter">
                    <div id="polyglotLanguageSwitcher">
                      
                      <ul class="dropdown">
                            
                        <li><a id="en" class="current" href="#">English<span class="trigger">»</span></a>
                                <ul>
                                    <li><a id="cn" href="cn">中文</a></li>
                                </ul>
                            </li>
                      </ul>
                    </div>
                </div>
                <div class="sitemap">
                    <a href="blog" title="News and articles" target="_blank">Blog</a>
                </div> -->
                <div id="copyright"><p>© 2013 ParisGoAirport - <a href="../terms.php" title="Terms and Conditions">Terms and Conditions</a></p></div>
            </div> <!-- end socialfooter -->
        </div>
        </form>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.10.1.min.js"><\/script>')</script>

        <script src="../js/main.js"></script>



    </body>
</html>
