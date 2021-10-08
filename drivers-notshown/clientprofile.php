<?php
session_start();
$id_users = $_SESSION['id'];

if(empty($_SESSION['id']))
{
  header('Location: login.php');
  exit();
}

  include '../config.php';

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Paris Airport - Client Profile</title>

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
                <h2>Paris - Airport Clients</h2>
                <p class="main-description">Fiche du client</p>

                <?php if(isset($ok)){ echo '<h3 id="ok">'.$ok.'</h3>';} 
            elseif(isset($erreurid)){ ?>
            
              <?php echo '<h3 id="erreurid">'.$erreurid.'</h3>'; } ?>
                
                <?php 


                      $resultats=$bdd->query('SELECT * FROM resachauffeurs WHERE id=\'' . $_GET['id'] . '\' ORDER BY coldate DESC');
                      $resultats->setFetchMode(PDO::FETCH_OBJ);
                      while( $resultat = $resultats->fetch() )
                      {
                              ?>

                                  <h3 class="title-prices-second"> 
                                    <?php if($resultat->way == '往返') { ?>
                                       Round-Trip
                                       <?php } if($resultat->way == '单程') { ?>
                                       One-Way
                                     <?php } else { ?>
                                     <?php echo $resultat->way; ?>
                                       <?php } ?>

                                    <?php if($resultat->tfairport == '送机') { ?>
                                       Pour
                                       <?php } if($resultat->tfairport == '接机') { ?>
                                       Depuis
                                     <?php } else { ?>
                                     <?php echo $resultat->tfairport; ?>
                                       <?php } ?> <?php echo $resultat->airport; ?> Terminal <?php echo $resultat->terminal; ?></h3>
                                    <table>

                                       <tr>
                                           <th>Flight Number</th>
                                           <td><?php echo $resultat->flightnumb; ?></td>
                                       </tr>
                                       <tr>
                                           <th>Pick up Date</th>
                                           <td><?php echo $resultat->arrivaldate; ?></td>
                                       </tr>
                                       <tr>
                                           <th>Pick up Time</th>
                                           <td><?php echo $resultat->arrivaltime; ?></td>
                                       </tr><?php if($resultat->way == 'Round-Trip' || $resultat->way == '往返') { ?>
                                       <tr>
                                           <th>Returning Date</th>
                                           <td><?php echo $resultat->returningdate; ?></td>
                                       </tr>
                                       <tr>
                                           <th>Returning Time</th>
                                           <td><?php echo $resultat->returningtime; ?></td>
                                       </tr><?php   } ?>
                                       <tr>
                                           <th>Name</th>
                                           <td><?php echo $resultat->name; ?></td>
                                       </tr>
                                       <tr>
                                           <th>Address in Paris</th>
                                           <td><?php echo $resultat->parisaddress; ?></td>
                                       </tr>
                                       <tr>
                                           <th>Phone</th>
                                           <td><?php echo $resultat->phone; ?></td>
                                       </tr>
                                       <tr>
                                           <th>Description</th>
                                           <td><?php echo $resultat->description; ?></td>
                                       </tr>

                                       <tr>
                                           <th>Persons</th>
                                           <td><?php echo $resultat->nbadults; ?></td>
                                       </tr>
                                       <tr class="total-price-confirmation">
                                       <th>Le client paye directement au chauffeur</th>
                                       <td><?php echo $resultat->shuttlefee; ?> €</td>
                                       </tr>
                                    

                                    <?php if ($resultat->idchauffeur == $id_users ) { ?><tr> <th>Course Accepté !</th> 
                                     <td><a href="clients.php?cancel=<?php echo $resultat->id; ?>" title="Annuler" class="cancel-client">Annuler</a></td></tr>
                                    <?php }

                                           else { ?>
                                           <tr><th>Accepter la Course</th>
                                           <td><a href="clients.php?valid=<?php echo $resultat->id; ?>" title="Accepter" class="accept-client">Oui</a></td> <?php } ?>
                                       </tr>
                                       </table>


                                          



                              <?php
                      }
                      $resultats->closeCursor();

                      ?> 

                      <div><br /><a href="clients.php" title="All Clients" class="tours">Back to Clients</a></div>
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
