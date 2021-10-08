<?php

session_start();
$id_users = $_SESSION['id'];

if(empty($_SESSION['id']))
{
  header('Location: login.php');
  exit();
}



include '../config.php';

// if get valid la case "idchauffeur" de la table "annonces" est egal a lid du pseudo qui la accepté -> lannonce ne se montre pas pour les autres id 


  if (isset($_GET['valid'])) {
    // On protège la variable "id_news" pour éviter une faille SQL
    $_GET['valid'] = addslashes($_GET['valid']);
    $id = $_GET['valid'];

 



    $req = $bdd->prepare('UPDATE resachauffeurs SET idchauffeur = :id_users WHERE id=:id');
    $req->execute(array(
      'id_users' => $id_users,
      'id' => $id
    ));
    $req->closeCursor();


        $stt = $bdd->prepare("SELECT * FROM resachauffeurs WHERE idchauffeur = :id_users");
        $stt->execute(array(':id_users' => $id_users));
        $resultresa = $stt->fetch(PDO::FETCH_OBJ);
        $stt->closeCursor();
        $name = $resultresa->name;
        $arrivaldate = $resultresa->arrivaldate;
        $arrivaltime = $resultresa->arrivaltime;
        $flightnumb = $resultresa->flightnumb;
        $airport = $resultresa->airport;
        $terminal = $resultresa->terminal;
        $phone = $resultresa->phone;
        $nbadults = $resultresa->nbadults;
        $parisaddress = $resultresa->parisaddress;
        $shuttlefee = $resultresa->shuttlefee;
        $description = $resultresa->description;


     $sth = $bdd->prepare("SELECT pseudo, email FROM chauffeurs WHERE id = :id_users");
        $sth->execute(array(':id_users' => $id_users));
        $result = $sth->fetch(PDO::FETCH_OBJ);
        $sth->closeCursor();
        $driveremail = $result->email;
        $driverpseudo = $result->pseudo;
        
      $ok = "Reservation accepté.";


                  require_once('../PHPMailer_5.2.4/class.phpmailer.php');
            //include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

            $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

            $mail->IsSMTP(); // telling the class to use SMTP

            try {
              $mailmessage = file_get_contents('accept.html');
              $mailmessage = str_replace('%arrivaldate%', $arrivaldate, $mailmessage);  
              $mailmessage = str_replace('%driverpseudo%', $driverpseudo, $mailmessage); 
              $mailmessage = str_replace('%name%', $name, $mailmessage); 
              $mailmessage = str_replace('%arrivaltime%', $arrivaltime, $mailmessage); 
              $mailmessage = str_replace('%flightnumb%', $flightnumb, $mailmessage); 
              $mailmessage = str_replace('%airport%', $airport, $mailmessage); 
              $mailmessage = str_replace('%terminal%', $terminal, $mailmessage); 
              $mailmessage = str_replace('%phone%', $phone, $mailmessage); 
              $mailmessage = str_replace('%nbadults%', $nbadults, $mailmessage); 
              $mailmessage = str_replace('%parisaddress%', $parisaddress, $mailmessage); 
              $mailmessage = str_replace('%shuttlefee%', $shuttlefee, $mailmessage); 
              $mailmessage = str_replace('%description%', $description, $mailmessage); 

              $mail->Host       = "ssl://in.mailjet.com"; // SMTP server
              $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
              $mail->SMTPAuth   = true;                  // enable SMTP authentication
              $mail->Host       = "ssl://in.mailjet.com"; // sets the SMTP server
              $mail->Port       = 443;                    // set the SMTP port for the GMAIL server
              $mail->Username   = "dsfqdsf"; // SMTP account username
              $mail->Password   = "sfds";        // SMTP account password
              $mail->AddAddress($driveremail);
              $mail->SetFrom('contact@parisgoairport.com');
              $mail->AddReplyTo('contact@parisgoairport.com', 'ParisGoAirport');
              $mail->AddCC('contact@parisgoairport.com');
              $mail->Subject = 'Reservation accepté';
              $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
              $mail->MsgHTML($mailmessage);
              $mail->CharSet="UTF-8";

              // $mail->AddAttachment('images/phpmailer.gif');      // attachment
              // $mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
              $mail->Send();
              
            } catch (phpmailerException $e) {
              echo $e->errorMessage(); //Pretty error messages from PHPMailer
            } catch (Exception $e) {
              echo $e->getMessage(); //Boring error messages from anything else!
            } 



} //end if valid


  if (isset($_GET['cancel'])) {
    // On protège la variable "id_news" pour éviter une faille SQL
    $_GET['cancel'] = addslashes($_GET['cancel']);
    $id = $_GET['cancel'];
    $id_cancel = 0;



      $stt = $bdd->prepare("SELECT * FROM resachauffeurs WHERE idchauffeur = :id_users");
        $stt->execute(array(':id_users' => $id_users));
        $resultresa = $stt->fetch(PDO::FETCH_OBJ);
        $stt->closeCursor();
        $name = $resultresa->name;
        $arrivaldate = $resultresa->arrivaldate;
        $arrivaltime = $resultresa->arrivaltime;
        $flightnumb = $resultresa->flightnumb;
        $airport = $resultresa->airport;
        $terminal = $resultresa->terminal;
        $phone = $resultresa->phone;
        $nbadults = $resultresa->nbadults;
        $parisaddress = $resultresa->parisaddress;
        $shuttlefee = $resultresa->shuttlefee;
        $description = $resultresa->description;


     $sth = $bdd->prepare("SELECT pseudo, email FROM chauffeurs WHERE id = :id_users");
        $sth->execute(array(':id_users' => $id_users));
        $result = $sth->fetch(PDO::FETCH_OBJ);
        $sth->closeCursor();
        $driveremail = $result->email;
        $driverpseudo = $result->pseudo;
        
      $ok = "Reservation accepté.";


                  require_once('../PHPMailer_5.2.4/class.phpmailer.php');
            //include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

            $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

            $mail->IsSMTP(); // telling the class to use SMTP

            try {
              $mailmessage = file_get_contents('cancel.html');
              $mailmessage = str_replace('%arrivaldate%', $arrivaldate, $mailmessage);  
              $mailmessage = str_replace('%driverpseudo%', $driverpseudo, $mailmessage); 
              $mailmessage = str_replace('%name%', $name, $mailmessage); 
              $mailmessage = str_replace('%arrivaltime%', $arrivaltime, $mailmessage); 
              $mailmessage = str_replace('%flightnumb%', $flightnumb, $mailmessage); 
              $mailmessage = str_replace('%airport%', $airport, $mailmessage); 
              $mailmessage = str_replace('%terminal%', $terminal, $mailmessage); 
              $mailmessage = str_replace('%phone%', $phone, $mailmessage); 
              $mailmessage = str_replace('%nbadults%', $nbadults, $mailmessage); 
              $mailmessage = str_replace('%parisaddress%', $parisaddress, $mailmessage); 
              $mailmessage = str_replace('%shuttlefee%', $shuttlefee, $mailmessage); 
              $mailmessage = str_replace('%description%', $description, $mailmessage); 

              $mail->Host       = "ssl://in.mailjet.com"; // SMTP server
              $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
              $mail->SMTPAuth   = true;                  // enable SMTP authentication
              $mail->Host       = "ssl://in.mailjet.com"; // sets the SMTP server
              $mail->Port       = 443;                    // set the SMTP port for the GMAIL server
              $mail->Username   = "qsdqd"; // SMTP account username
              $mail->Password   = "qsdsqd";        // SMTP account password
              $mail->AddAddress($driveremail);
              $mail->SetFrom('contact@parisgoairport.com');
              $mail->AddReplyTo('contact@parisgoairport.com', 'ParisGoAirport');
              $mail->AddCC('contact@parisgoairport.com');
              $mail->Subject = 'Reservation annulé';
              $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
              $mail->MsgHTML($mailmessage);
              $mail->CharSet="UTF-8";

              // $mail->AddAttachment('images/phpmailer.gif');      // attachment
              // $mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
              $mail->Send();
              
            } catch (phpmailerException $e) {
              echo $e->errorMessage(); //Pretty error messages from PHPMailer
            } catch (Exception $e) {
              echo $e->getMessage(); //Boring error messages from anything else!
            } 



    $req = $bdd->prepare('UPDATE resachauffeurs SET idchauffeur = :id_cancel WHERE id=:id');
    $req->execute(array(
      'id_cancel' => $id_cancel,
      'id' => $id
    ));
    $req->closeCursor();
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
                <h2>Transfer Clients</h2>
                <p class="main-description">Clients Paris - Orly - CDG - Beauvais</p>

                
              <table>
                
                     <?php 


                     

      



                              $resultats=$bdd->query('SELECT * FROM resachauffeurs ORDER BY coldate DESC');
                              $resultats->setFetchMode(PDO::FETCH_OBJ);
                              while( $resultat = $resultats->fetch() )
                              { 
                                  if ($resultat->idchauffeur == 0 || $resultat->idchauffeur == $id_users) {

                                ?>
                                         

                                          
                                        <tr>
                                           <th><a href="clientprofile.php?id=<?php echo $resultat->id; ?>" title="Client" class="lien-ficheclient"><?php echo $resultat->name; ?></a></th>
                                           <?php
                                            echo '<td><span class="clients-date">'.$resultat->arrivaldate.' - '.$resultat->arrivaltime.'</span></td>';
                                            echo '<td><a href="clientprofile.php?id='.$resultat->id.'" title="Client" class="lien-ficheclient">'.$resultat->way.' '.$resultat->tfairport.' '.$resultat->airport.'</a></td>';
                                           if ($resultat->idchauffeur == $id_users ) { ?> <td>Accepté!</td>
                                           <td><a href="clients.php?cancel=<?php echo urlencode($resultat->id); ?>" title="Annuler" class="cancel-client">Annuler</a></td>

                                            <?php }

                                           else { ?>
                                           <td><a href="clients.php?valid=<?php echo urlencode($resultat->id); ?>" title="Accepter" class="accept-client">Accepter</a></td> <?php } ?>
                                       </tr>


                                          

                                      <?php 
                                    }
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
