<?php


  include '../config.php';


 // require_once('recaptchalib.php'); this is captcha
  ///$privatekey = "-1t5sbL4gleF";
  //$resp = recaptcha_check_answer ($privatekey,
  //                              $_SERVER["REMOTE_ADDR"],
   //                             $_POST["recaptcha_challenge_field"],
  //                              $_POST["recaptcha_response_field"]);

  //if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly

   // header('Location: reservation.php?recaptcha=false');

    // die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
        // "(reCAPTCHA said: " . $resp->error . ")");
 // } else {
    // Your code here to handle a successful verification

$varget = $_POST['airport'];
$way = $_POST['way'];


if(isset($_POST['submit']))  {

  if($way == 'One-Way') {
        if(!empty($_POST['firstname']) && ($_POST['firstname'] != "Firstname") && !empty($_POST['lastname']) && ($_POST['lastname'] != "Lastname") && !empty($_POST['arrivaldate'])
         && ($_POST['arrivaldate'] != "Arrival/Departing Date")  && !empty($_POST['arrivaltime']) && ($_POST['arrivaltime'] != "Arrival/Departing Time")   
          && !empty($_POST['flightnumb']) && ($_POST['flightnumb'] != "Flight Number")   && !empty($_POST['airport']) && ($_POST['airport'] != "Airport")
             && !empty($_POST['parisaddress']) && ($_POST['parisaddress'] != "Paris Address") && !empty($_POST['terminal']) && ($_POST['terminal'] != "Airport Terminal")
               && !empty($_POST['email']) && ($_POST['email'] != "Email")  && !empty($_POST['phone']) && ($_POST['phone'] != "Phone with country code")
            && ($_POST['tfairport'] != "To or From airport ?")  && ($_POST['shuservice'] != "Shuttle Service") && ($_POST['nbadults'] != "Adults (over 3 years old)")
              && ($_POST['nbchildren'] != "Children (under 3 years old)") && preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $_POST['email']) && !empty($_POST['num1'])
               && !empty($_POST['num2']) && !empty($_POST['captcha']) && ($_POST['captcha'] != "Human ?")) {
                extract($_POST);
                $num1 = $_POST['num1'];
                $num2 = $_POST['num2'];
                $total = $_POST['captcha'];
                if( intval($num1) + intval($num2) == intval($total) ) {
                          $valid = true;
                  }
                  else {
                          $valid = false;
          
                          header('Location: one-way-reservation.php?varget='.urlencode($varget).'&way='.urlencode($way).'&captcha=false');
                  }
          
          } else {
           $valid = false;
          
           header('Location: one-way-reservation.php?varget='.urlencode($varget).'&way='.urlencode($way).'&notvalid=false');

          }
    }

    if($way == 'Round-Trip') {
        if(!empty($_POST['firstname']) && ($_POST['firstname'] != "Firstname") && !empty($_POST['lastname']) && ($_POST['lastname'] != "Lastname") && !empty($_POST['arrivaldate'])
         && ($_POST['arrivaldate'] != "Arrival/Departing Date")  && !empty($_POST['arrivaltime']) && ($_POST['arrivaltime'] != "Arrival/Departing Time") 
           && ($_POST['returningdate'] != "Returning Date")  && !empty($_POST['returningtime']) && ($_POST['returningtime'] != "Returning Time")    
          && !empty($_POST['flightnumb']) && ($_POST['flightnumb'] != "Flight Number")   && !empty($_POST['airport']) && ($_POST['airport'] != "Airport")
             && !empty($_POST['parisaddress']) && ($_POST['parisaddress'] != "Paris Address") && !empty($_POST['terminal']) && ($_POST['terminal'] != "Airport Terminal")
               && !empty($_POST['email']) && ($_POST['email'] != "Email")  && !empty($_POST['phone']) && ($_POST['phone'] != "Phone with country code")
            && ($_POST['tfairport'] != "To or From airport ?")  && ($_POST['shuservice'] != "Shuttle Service") && ($_POST['nbadults'] != "Adults (over 3 years old)")
              && ($_POST['nbchildren'] != "Children (under 3 years old)") && preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $_POST['email']) && !empty($_POST['num1'])
               && !empty($_POST['num2']) && !empty($_POST['captcha']) && ($_POST['captcha'] != "Human ?")) {
                extract($_POST);
                $num1 = $_POST['num1'];
                $num2 = $_POST['num2'];
                $total = $_POST['captcha'];
                if( intval($num1) + intval($num2) == intval($total) ) {
                          $valid = true;
                  }
                  else {
                          $valid = false;
          
                          header('Location: round-trip-reservation.php?varget='.urlencode($varget).'&way='.urlencode($way).'&captcha=false');
                  }
          
          } else {
           $valid = false;
          
           header('Location: round-trip-reservation.php?varget='.urlencode($varget).'&way='.urlencode($way).'&notvalid=false');

          }
    }
  
  if($valid)
  {
   // header("confirmreserv.php");

  

    date_default_timezone_set('Europe/Madrid');
    $coldate = date('Y-m-d H:i:s');
    
      $firstname = htmlspecialchars($_POST['firstname']);
      $lastname = htmlspecialchars($_POST['lastname']);
      $arrivaldate = htmlspecialchars(date('Y-m-d', strtotime($_POST['arrivaldate']))); 
      $arrivaltime = htmlspecialchars($_POST['arrivaltime']);
      $flightnumb = htmlspecialchars($_POST['flightnumb']);
      $airport = htmlspecialchars($_POST['airport']);
      $terminal = htmlspecialchars($_POST['terminal']);
      $email = htmlspecialchars($_POST['email']);
      $phone = htmlspecialchars($_POST['phone']);
      $parisaddress = htmlspecialchars($_POST['parisaddress']);
      $tfairport = htmlspecialchars($_POST['tfairport']);
      $shuservice = htmlspecialchars($_POST['shuservice']);
      $nbadults = htmlspecialchars($_POST['nbadults']);
      $nbchildren = htmlspecialchars($_POST['nbchildren']);

      if($way == 'Round-Trip') {
        $returningdate = htmlspecialchars(date('Y-m-d', strtotime($_POST['returningdate']))); 
        $returningtime = htmlspecialchars($_POST['returningtime']);
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
        <title>Paris Airport Transfers</title>

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

        <?php include '../header.php'; ?>

        <div class="main-container">
            <div class="main wrapper clearfix">
              <div class="paddingdiv">

                <h2>Confirm your Reservation</h2>
                <p class="main-description">Confirm that the details below are correct. <a href="shuttle-prices.php" title="Prices" target="_blank">Shuttle prices</a></p>

                        <?php if(isset($ok)){ echo '<p id="ok">'.$ok.'</p>';} 
                    elseif(isset($erreurid)){ ?>
                    
                      <?php echo '<p id="erreurid">'.$erreurid.'</p>'; } ?>


            

                        <h3 class="title-prices-second"><?php echo $way; ?> <?php echo $tfairport; ?> <?php echo $airport; ?> <?php echo $terminal; ?></h3>
                    <table>
                       <tr>
                           <th>Flight Number</th>
                           <td><?php echo $flightnumb; ?></td>
                       </tr>
                       <tr>
                           <th>Flight arrival date / departing date from Paris</th>
                           <td><?php echo $arrivaldate; ?></td>
                       </tr>
                       <tr>
                           <th>Flight arrival time / departing time from Paris</th>
                           <td><?php echo $arrivaltime; ?></td>
                       </tr><?php if($way == 'Round-Trip') { ?>
                       <tr>
                           <th>Returning Date</th>
                           <td><?php echo $returningdate; ?></td>
                       </tr>
                       <tr>
                           <th>Returning Time</th>
                           <td><?php echo $returningtime; ?></td>
                       </tr><?php   } ?>
                       <tr>
                           <th>Firstname</th>
                           <td><?php echo $firstname; ?></td>
                       </tr>
                       <tr>
                           <th>Lastname</th>
                           <td><?php echo $lastname; ?></td>
                       </tr>
                       <tr>
                           <th>Address in Paris</th>
                           <td><?php echo $parisaddress; ?></td>
                       </tr>
                       <tr>
                           <th>Email</th>
                           <td><?php echo $email; ?></td>
                       </tr>
                       <tr>
                           <th>Phone</th>
                           <td><?php echo $phone; ?></td>
                       </tr>
                       <tr>
                           <th>Shuttle Service</th>
                           <td><?php echo $shuservice; ?></td>
                       </tr>
                       <tr>
                           <th>Persons</th>
                           <td><?php echo $nbadults; ?></td>
                       </tr>
                       <tr>
                           <th>Baby Seats (no fee)</th>
                           <td><?php echo $nbchildren; ?></td>
                       </tr>
                       




                    <tr class="total-price-confirmation">
                           <th>Total Price</th>
                           <td>
                    <?php

                    $oneper = "25";
                    $twoper ="40";
                    $threeper ="55";
                    $fourper = "58";
                    $fiveper = "65";
                    $sixper = "70";
                    $sevenper = "75";
                    $eightper = "80";

                    $oneperpriv = "60";
                    $twoperpriv ="60";
                    $threeperpriv ="60";
                    $fourperpriv = "60";
                    $fiveperpriv = "80";
                    $sixperpriv = "80";
                    $sevenperpriv = "80";
                    $eightperpriv = "80";

                    if ($way == "One-Way") {
                     
                         if($shuservice == "Shared") {

                            

                                if($nbadults == "1"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee= $oneper; echo $shuttlefee;}
                                  else{ $shuttlefee=$oneper+10; echo $shuttlefee;}
                                }
                              if($nbadults == "2"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$twoper; echo $shuttlefee;}
                                  else{ $shuttlefee=$twoper+10; echo $shuttlefee;}
                                }
                              if($nbadults == "3"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$threeper; echo $shuttlefee;}
                                  else{ $shuttlefee=$threeper+10; echo $shuttlefee;}
                                }
                              if($nbadults == "4"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$fourper; echo $shuttlefee;}
                                  else { $shuttlefee=$fourper+10; echo $shuttlefee;}
                                }
                              if($nbadults == "5"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$fiveper; echo $shuttlefee;}
                                  else{ $shuttlefee=$fiveper+10; echo $shuttlefee;}
                                }
                              if($nbadults == "6"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$sixper; echo $shuttlefee;}
                                  else{ $shuttlefee=$sixper+10; echo $shuttlefee;}
                                }
                              if($nbadults == "7"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$sevenper; echo $shuttlefee;}
                                  else{ $shuttlefee=$sevenper+10; echo $shuttlefee;}
                                }
                              if($nbadults == "8"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$eightper; echo $shuttlefee;}
                                  else{ $shuttlefee=$eightper+10; echo $shuttlefee;}
                                }

                            

                          } // end Shared


                        if($shuservice == "Private") {

                          if($nbadults == "1"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee= $oneperpriv; echo $shuttlefee;}
                                  else{ $shuttlefee=$oneperpriv+10; echo $shuttlefee;}
                                }
                              if($nbadults == "2"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$twoperpriv; echo $shuttlefee;}
                                  else{ $shuttlefee=$twoperpriv+10; echo $shuttlefee;}
                                }
                              if($nbadults == "3"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$threeperpriv; echo $shuttlefee;}
                                  else{ $shuttlefee=$threeperpriv+10; echo $shuttlefee;}
                                }
                              if($nbadults == "4"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$fourperpriv; echo $shuttlefee;}
                                  else { $shuttlefee=$fourperpriv+10; echo $shuttlefee;}
                                }
                              if($nbadults == "5"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$fiveperpriv; echo $shuttlefee;}
                                  else{ $shuttlefee=$fiveperpriv+10; echo $shuttlefee;}
                                }
                              if($nbadults == "6"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$sixperpriv; echo $shuttlefee;}
                                  else{ $shuttlefee=$sixperpriv+10; echo $shuttlefee;}
                                }
                              if($nbadults == "7"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$sevenperpriv; echo $shuttlefee;}
                                  else{ $shuttlefee=$sevenperpriv+10; echo $shuttlefee;}
                                }
                              if($nbadults == "8"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$eightperpriv; echo $shuttlefee;}
                                  else{ $shuttlefee=$eightperpriv+10; echo $shuttlefee;}
                                }
                        } // end private
                    } // end one-way


                    // ne pas oublier aussi le faire pour le time du retour
                    // -6% = total * 0.94
                    // From Airport To Paris and return for 4 persons : ((26+22) * 4) * 0.94 
                    if ($way == "Round-Trip") {
                     
                         if($shuservice == "Shared") {

                            

                                if($nbadults == "1"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee= $oneper*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$oneper*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "2"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$twoper*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$twoper*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "3"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$threeper*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$threeper*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "4"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$fourper*2; echo $shuttlefee;}
                                  else { $shuttlefee=$fourper*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "5"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$fiveper*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$fiveper*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "6"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$sixper*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$sixper*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "7"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$sevenper*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$sevenper*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "8"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$eightper*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$eightper*2; $shuttlefee += 10; echo $shuttlefee;}
                                }

                            

                          } // end Shared


                        if($shuservice == "Private") {

                          if($nbadults == "1"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee= $oneperpriv*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$oneperpriv*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "2"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$twoperpriv*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$twoperpriv*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "3"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$threeperpriv*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$threeperpriv*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "4"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$fourperpriv*2; echo $shuttlefee;}
                                  else { $shuttlefee=$fourperpriv*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "5"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$fiveperpriv*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$fiveperpriv*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "6"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$sixperpriv*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$sixperpriv*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "7"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$sevenperpriv*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$sevenperpriv*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                              if($nbadults == "8"){
                                  if($arrivaltime > "06:00" && $arrivaltime < "20:30") { $shuttlefee=$eightperpriv*2; echo $shuttlefee;}
                                  else{ $shuttlefee=$eightperpriv*2; $shuttlefee += 10; echo $shuttlefee;}
                                }
                        } // end private
                    } // end round-trip




                     ?> €</td>
                       </tr>
                    </table>



                     <form class="login-form" id="SignupForm" action="../tours.php" method="post">
                     <!-- <a href="shuttle-prices.php" title="Prices">Check the prices</a> -->
                    <input type="hidden" name="firstname" value="<?php echo $firstname; ?>" />
                    <input type="hidden" name="lastname" value="<?php echo $lastname; ?>" />
                    <input type="hidden" name="arrivaldate" value="<?php echo $arrivaldate; ?>" />
                    <input type="hidden" name="arrivaltime" value="<?php echo $arrivaltime; ?>" />
                    <input type="hidden" name="flightnumb" value="<?php echo $flightnumb; ?>" />
                    <input type="hidden" name="airport" value="<?php echo $airport; ?>" />
                    <input type="hidden" name="way" value="<?php echo $way; ?>" />
                    <input type="hidden" name="terminal" value="<?php echo $terminal; ?>" />
                    <input type="hidden" name="email" value="<?php echo $email; ?>" />
                    <input type="hidden" name="phone" value="<?php echo $phone; ?>" />
                    <input type="hidden" name="parisaddress" value="<?php echo $parisaddress; ?>" />
                    <input type="hidden" name="tfairport" value="<?php echo $tfairport; ?>" />
                    <input type="hidden" name="shuservice" value="<?php echo $shuservice; ?>" />
                    <input type="hidden" name="nbadults" value="<?php echo $nbadults; ?>" />
                    <input type="hidden" name="nbchildren" value="<?php echo $nbchildren; ?>" />
                    <input type="hidden" name="shuttlefee" value="<?php echo $shuttlefee; ?>" />
                    <?php if($way == 'Round-Trip') { ?>
                    <input type="hidden" name="returningdate" value="<?php echo $returningdate; ?>" />
                    <input type="hidden" name="returningtime" value="<?php echo $returningtime; ?>" />
                    <?php   } ?>

                  </div>

            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
              <div class="paddingdiv">
                <input type="submit" id="SaveAccount" name="submit" value="Submit" class="button" />
                <div class="contacticon"><a href="../contact.php" title="Contact us" class="contactlink">Contact</a></div>
                <div class="homeicon"><a href="../index.php" title="Home" class="homelink">Home</a></div>
                <div class="toursicon"><a href="../tours.php" title="Sightseeing Tours" class="tourslink">Sightseeing</a></div>
              </div>
            </footer>
            <div id="copyright"><p>© 2013 ParisGoAirport - <a href="../terms.php" title="Terms and Conditions">Terms</a></p></div>
        </div>
         </form>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.10.1.min.js"><\/script>')</script>

        <script src="../js/main.js"></script>

<?php
// hide captcha  } // end captcha
}
}

?>
    </body>
</html>
